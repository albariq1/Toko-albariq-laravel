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

class TransaksiController extends Controller
{
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

        return view('kasir.transaksi.index', compact('pelanggan', 'barang', 'detail', 'totBelanja'));
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

    public function store_penjualan()
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
                'grand_total' => $getDetail[0]->total
            ]);

            $updateDetail = DetailPenjualan::where('status', '0')->where('user_id', Auth::user()->id)->update([
                'penjualan_id' => $storePenjualan->id,
                'status' => '1'
            ]);

            // success transaction
            DB::commit();

            return redirect()->back()->with([
                'success' => 'Data berhasil diproses!'
            ]);
        } catch (Exception $error) {
            // saat gagal, maka cancel smua transaction data
            DB::rollBack();

            return redirect()->back()->with([
                'failed' => 'Data gagal ditambah, karena ' . $error->getMessage()
            ]);
        }
    }
}
