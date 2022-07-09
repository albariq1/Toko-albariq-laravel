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

        return view('manajer_pemilik.return.index', compact('data', 'barang', 'pemasok', 'kategori'));
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
            ->first();

        $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return;

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
}
