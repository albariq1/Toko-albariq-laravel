<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pemasok;
use App\Models\ReturnBarang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;


class ReturnBarangController extends Controller
{
    public function index()
    {
        $data = DB::table('return_barangs')
            ->select(DB::raw('return_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok'))
            ->join('barangs', 'barangs.id', 'return_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->orderBy('barangs.barcode', 'DESC')
            ->get();

        $barang = DB::table('barangs')
            ->select('barangs.*', 'kategoris.nama_katagori', 'pemasoks.nama_pemasok')
            ->join('kategoris', 'kategoris.id', 'barangs.kategori_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->get();

        $pemasok = Pemasok::orderBy('nama_pemasok', 'ASC')->get(); // ambil data pemasok
        $kategori = Kategori::orderBy('nama_katagori', 'ASC')->get();


        if (Auth::user()->role == 'Direktur') {
            return view('direktur.return.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Sekretaris') {
            return view('direktur.return.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Keuangan') {
            return view('direktur.return.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Staf Gudang') {
            return view('manajer_pemilik.return.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Admin') {
            return view('manajer_pemilik.return.index', compact('data', 'barang', 'pemasok', 'kategori'));
        }

        // return view('manajer_pemilik.return.index', compact('data', 'barang', 'pemasok', 'kategori'));
    }

    public function store(Request $request)
    {
        $total = $request->harga_beli * $request->jumlah_beli;
        //cek Ketersediaan stok
        $getJumlah = DB::table('pembelian_barangs')
            ->select(DB::raw('SUM(jumlah_beli) as stok'))
            ->where('barang_id', $request->barang_id)
            ->first();

        // ambil jumlah (SUM) dari tabel detail_penjualans
        // berdasarka $request->barang_id barangs yg dipilih
        $getJumlahTerjual = DB::table('detail_penjualans')
            ->select(DB::raw('SUM(jumlah) as jumlah_terjual'))
            ->where('barang_id', $request->barang_id)
            ->first();

        $getJumlahReturn = DB::table('return_barangs')
            ->select(DB::raw('SUM(jumlah_return) as jumlah_return'))
            ->where('barang_id', $request->barang_id)
            ->where('status', '0')
            ->first();

        // $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return;

        $getJumlahHilang = DB::table('kehilangan_barangs')
            ->select(DB::raw('SUM(jumlah_hilang) as jumlah_hilang'))
            ->where('barang_id', $request->barang_id)
            ->where('status', '0')
            ->first();
        $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return - $getJumlahHilang->jumlah_hilang;
        if ($request->jumlah_return > $sisaStok) {
            return redirect()->back()->with([
                'failed' => 'Jumlah Melebihi Stok Barang!'
            ]);
            die;
        }
        try {
            //proses input data ke tabel
            // eloquent
            $store = ReturnBarang::Create(
                [
                    'barang_id' => $request->barang_id,
                    'jumlah_return' => $request->jumlah_return,
                    'alasan' => $request->alasan,
                    'user_id' => Auth::user()->id
                ]
            );
            return redirect('tabel_return')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_return')->with([
                'failed' => 'Data Gagal Ditambah! Karena' . $error->getMessage()
            ]);
        }
    }
    public function updateStatus($id)
    {
        // dd($id);
        try {
            //proses input data ke tabel
            // eloquent
            $store = ReturnBarang::find($id)->update([
                'status' => '1',
                'tgl_update_status' => date('Y-m-d'),
            ]);

            return redirect('tabel_return')->with([
                'success' => 'Status Berhasil Diupdate!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_return')->with([
                'failed' => 'Status Gagal Diupdate! Karena' . $error->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            //proses update data ke tabel
            // eloquent
            // ambil data user berdasarkan id yang dikirim dari form
            ReturnBarang::destroy($request->id);

            return redirect('tabel_return')->with([
                'success' => 'Data Berhasil DiHapus!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_return')->with([
                'failed' => 'Data Gagal DiHapus!,Karena' . $error->getMessage()
            ]);
        }
    }
    public function printReturn(Request $request)
    {

        $datareturn = DB::table('return_barangs')
            ->select(DB::raw('return_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok'))
            ->join('barangs', 'barangs.id', 'return_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->orderBy('barangs.barcode', 'DESC')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('direktur.return.print', compact('datareturn', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('barcode-barang.pdf');
    }
}
