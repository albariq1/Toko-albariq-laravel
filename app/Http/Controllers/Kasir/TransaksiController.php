<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\PembelianBarang;
use App\Models\PenjualanBarang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class TransaksiController extends Controller
{
    public function penjualanToday()
    {
        $today = date('Y-m-d');
        $detail = DB::table('penjualan_barangs')
            ->select(DB::raw('penjualan_barangs.*, users.name, pelanggans.nama_pelanggan '))
            ->join('users', 'users.id', 'penjualan_barangs.user_id')
            ->leftJoin('pelanggans', 'pelanggans.id', 'penjualan_barangs.pelanggan_id')
            ->where('penjualan_barangs.tanggal_transaksi', $today)
            ->where('penjualan_barangs.user_id', Auth::user()->id) // user_id yang dimasudkan pada kasih yang menginput
            ->orderBy('id', 'DESC')
            ->get();


        $grandTotal = DB::table('penjualan_barangs')
            ->select(DB::raw('penjualan_barangs.*, SUM(grand_total) as totalBelanjaan '))
            ->join('detail_penjualans', 'detail_penjualans.penjualan_id', 'penjualan_barangs.id')
            ->where('detail_penjualans.status', '1')
            ->where('detail_penjualans.user_id', Auth::user()->id) // user_id dimaksudkan pada kasir yg menginput
            ->where('penjualan_barangs.tanggal_transaksi', $today)
            ->first();

        $data = [
            'detail' =>  $detail,
            'grandTotal' => $grandTotal
        ];

        return $data;
    }
    public function history_transaksi()
    {
        $history = $this->penjualanToday();

        return view('kasir.transaksi.history', compact('history'));
    }
    public function index()
    {

        // menampilkan data pelanggan utk diform transaksi
        $pelanggan = Pelanggan::orderBy('nama_pelanggan')->get();
        // menampilkan data barang utk diform transaksi
        $barang = DB::table('pembelian_barangs')
            ->select(DB::raw('pembelian_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'pembelian_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->groupBy('pembelian_barangs.barang_id')
            ->orderBy('barangs.barcode', 'DESC')
            ->get();
        // menampilkan list detail penjualan yg statusny masih 0 di tabel transaksi sebelah kanan
        $detail = DB::table('detail_penjualans')
            ->select(DB::raw('detail_penjualans.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan '))
            ->join('barangs', 'barangs.id', 'detail_penjualans.barang_id')
            ->where('detail_penjualans.status', '0')
            ->where('detail_penjualans.user_id', Auth::user()->id) // user_id dimaksudkan pada kasir yg menginput
            ->get();
        // menghitung totalharga yg ada di tabel detail_penjualans yg statusny 0 (masih keranjang)
        $total = DB::table('detail_penjualans')
            ->select(DB::raw('SUM(totalharga) as totalbelanja '))
            ->where('status', '0')
            ->first();
        $totBelanja = $total->totalbelanja;

        $penjualanToday = $this->penjualanToday();

        return view('kasir.transaksi.index', compact('pelanggan', 'barang', 'detail', 'totBelanja', 'penjualanToday'));
    }

    public function store(Request $request)
    {
        try {
            $getLastBarang = PembelianBarang::where('barang_id', $request->barang_id)->orderBy('id', 'DESC')->first();

            $harga = $getLastBarang->harga_jual;

            $cekKeranjang = DetailPenjualan::where('barang_id', $request->barang_id)->where('status', '0')->where('user_id', Auth::user()->id);

            if ($cekKeranjang->first()) {
                // ambil datanya
                $data = $cekKeranjang->first();
                $cekKeranjang->update([
                    'jumlah' => $data->jumlah + $request->jumlah,
                    'totalharga' => ($data->jumlah + $request->jumlah) * $harga
                ]);
            } else {
                DetailPenjualan::create([
                    'barang_id' => $request->barang_id,
                    'jumlah' => $request->jumlah,
                    'totalharga' => $request->jumlah * $harga,
                    'status' => '0',
                    'pelanggan_id' => $request->pelanggan_id,
                    'tanggal_transaksi' => date('Y-m-d'),
                    'user_id' => Auth::user()->id
                ]);
            }

            return redirect()->back()->with([
                'success' => 'Data berhasil ditambah!'
            ]);
        } catch (Exception $error) {

            return redirect()->back()->with([
                'failed' => 'Data gagal ditambah, karena ' . $error->getMessage()
            ]);
        }
    }

    public function store_penjualan(Request $request)
    {
        $user_id = Auth::user()->id;
        // opening db transaction
        DB::beginTransaction();
        try {
            $getDetail = DB::select("SELECT SUM(totalharga) as total FROM detail_penjualans WHERE status = '0' AND user_id = $user_id ");
            // dd($getDetail);
            $datas =  DB::select("SELECT MAX(RIGHT(kode_penjualan, 4)) as lastkode FROM penjualan_barangs");
            $kode = "";

            if ($datas) {
                foreach ($datas as $k) {
                    $tmp = ((int)$k->lastkode) + 1;
                    $kode = sprintf("%04s", $tmp);
                }
            } else {
                $kode = "0001";
            }

            $storePenjualan = PenjualanBarang::create([
                'kode_penjualan' => "BRQ-" . $kode,
                'pelanggan_id' => $request->pelanggan_id,
                'grand_total' => $getDetail[0]->total,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->kembalian,
                'user_id' => Auth::user()->id,
                'tanggal_transaksi' => date('Y-m-d'),
            ]);

            $updateDetail = DetailPenjualan::where('status', '0')->where('user_id', Auth::user()->id)->update([
                'penjualan_id' => $storePenjualan->id,
                'status' => '1'
            ]);

            // success transaction
            DB::commit();

            //penggail function download pdf invoice menggunakan redirect
            return redirect()->route('kasir.cetak-invoice', ['id' => $storePenjualan->id]);

            // return redirect()->back()->with([
            //     'success' => 'Data berhasil diproses!'
            // ]);
        } catch (Exception $error) {
            // saat gagal, maka cancel smua transaction data
            DB::rollBack();

            return redirect()->back()->with([
                'failed' => 'Data gagal ditambah, karena ' . $error->getMessage()
            ]);
        }
    }

    public function cetak_invoice($id)
    {

        //ambbil data detail penjualans berdasarkan id penjualan yg dipilih
        $data = DB::table('detail_penjualans')
            ->join('barangs', 'barangs.id', 'detail_penjualans.barang_id')
            ->where('detail_penjualans.penjualan_id', $id)
            ->get();
        // tampilkan data tabel penjualan_barangs berdasarkan id penjualan yg dipilih
        $penjualan = PenjualanBarang::find($id);
        // setting view untuk dijadikan file pdf
        $pdf = PDF::loadView('kasir.transaksi.invoice', compact('data', 'penjualan'));
        //setting size paprer printer kasir, layout kertas (potrair / landscape)
        $pdf->setPaper([0, 0, 204, 650], 'potrait');
        //setting dpi file pdf
        $pdf->setOptions(['dpi', 72]);
        //fungsi untuk menjalankan perintah print pdf / download pdf
        return $pdf->stream('struk-penjualan.pdf');
    }
}
