<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\PembelianBarang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PembelianBarangController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('pembelian_barangs')
            ->select(DB::raw('pembelian_barangs.*, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'pembelian_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->groupBy('pembelian_barangs.barang_id')
            // ->orderBy('pembelian_barangs.id', 'DESC')
            ->orderBy('barangs.id', 'ASC')
            ->get();

        $barang = DB::table('barangs')
            ->select('barangs.*', 'kategoris.nama_katagori', 'pemasoks.nama_pemasok')
            ->join('kategoris', 'kategoris.id', 'barangs.kategori_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->get();
        $id_barang = $request->id_barang;

        if (Auth::user()->role == 'Direktur') {
            return view('direktur.pembelian_barang.index', compact('data', 'barang', 'id_barang'));
        } else if (Auth::user()->role == 'Sekretaris') {
            return view('direktur.pembelian_barang.index', compact('data', 'barang', 'id_barang'));
        } else if (Auth::user()->role == 'Keuangan') {
            return view('direktur.pembelian_barang.index', compact('data', 'barang', 'id_barang'));
        } else if (Auth::user()->role == 'Staf Gudang') {
            return view('manajer_pemilik.pembelian_barang.index', compact('data', 'barang', 'id_barang'));
        } else if (Auth::user()->role == 'Admin') {
            return view('manajer_pemilik.pembelian_barang.index', compact('data', 'barang', 'id_barang'));
        }

        // return view('manajer_pemilik.pembelian_barang.index', compact('data', 'barang'));
    }

    public function store(Request $request)
    {
        // validasi
        // $request->validate(
        //     [
        //         'email' => 'required|email|unique:users',
        //         'name' => 'required|min:3',
        //         'nama_barang' => 'required|min:11|max:15',
        //         'password' => 'required',
        //         'kategori_id' => 'required',
        //         'role' => 'required',


        //     ]
        // );
        $total = $request->harga_beli * $request->jumlah_beli;
        try {
            //proses input data ke tabel
            // eloquent
            $store = PembelianBarang::create(
                [
                    'barang_id' => $request->barang_id,
                    'tanggal_pembelian' => $request->tanggal_pembelian,
                    'harga_beli' => $request->harga_beli,
                    'jumlah_beli' => $request->jumlah_beli,
                    'harga_jual' => $request->harga_jual,
                    'total' => $total,
                    'user_id' => Auth::user()->id
                ]
            );

            return redirect('tabel_pembelian_barang')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_pembelian_barang')->with([
                'failed' => 'Data Gagal Ditambah! Karena' . $error->getMessage()
            ]);
        }
    }

    public function detail($id)
    {
        $data = DB::table('pembelian_barangs')
            ->select(DB::raw('pembelian_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'pembelian_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->where('barangs.id', $id)
            ->get();

        // ambil jumlal_beli(SUM) dari tabel pembelian_barangs
        // berdasarkan id barangs yg dipilih
        $getJumlah = DB::table('pembelian_barangs')
            ->select(DB::raw('SUM(jumlah_beli) as stok'))
            ->where('barang_id', $id)
            ->first();

        // ambil jumlah (SUM) dari tabel detail_penjualans
        // berdasarkan id barangs yg dipilih
        $getJumlahTerjual = DB::table('detail_penjualans')
            ->select(DB::raw('SUM(jumlah) as jumlah_terjual'))
            ->where('barang_id', $id)
            ->first();

        $getJumlahReturn = DB::table('return_barangs')
            ->select(DB::raw('SUM(jumlah_return) as jumlah_return'))
            ->where('barang_id', $id)
            ->where('status', '0')
            ->first();


        $getJumlahHilang = DB::table('kehilangan_barangs')
            ->select(DB::raw('SUM(jumlah_hilang) as jumlah_hilang'))
            ->where('barang_id', $id)
            ->where('status', '0')
            ->first();

        $getLast = PembelianBarang::where('barang_id', $id)->orderBy('id', 'DESC')->first();  // utk mengambil dta barang yg terakhir, utk ambil harga dsb

        $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return; //pengurangan total barang yang dibeli dengen total barang yang terjual

        return  view('manajer_pemilik.pembelian_barang.detail', compact('data', 'getJumlah', 'getJumlahTerjual', 'sisaStok', 'getLast', 'getJumlahReturn', 'getJumlahHilang'));
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduk = DB::table('pembelian_barangs')
            ->select(DB::raw('pembelian_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'pembelian_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->groupBy('pembelian_barangs.barang_id')
            ->orderBy('barangs.barcode', 'ASC')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('manajer_pemilik.pembelian_barang.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('barcode-produk.pdf');
    }

    public function printpembelian(Request $request)
    {
        $dataproduk = DB::table('pembelian_barangs')
            ->select(DB::raw('pembelian_barangs.*, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'pembelian_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->groupBy('pembelian_barangs.barang_id')
            // ->orderBy('pembelian_barangs.id', 'DESC')
            ->orderBy('barangs.id', 'ASC')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('direktur.pembelian_barang.print', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('tabel_stok.pdf');
    }

    public function printPembelianBarang(Request $id)
    {
        $data = DB::table('pembelian_barangs')
            ->select(DB::raw('pembelian_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'pembelian_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->where('barangs.id', $id)
            ->get();

        // ambil jumlal_beli(SUM) dari tabel pembelian_barangs
        // berdasarkan id barangs yg dipilih
        $getJumlah = DB::table('pembelian_barangs')
            ->select(DB::raw('SUM(jumlah_beli) as stok'))
            ->where('barang_id', $id)
            ->first();

        // ambil jumlah (SUM) dari tabel detail_penjualans
        // berdasarkan id barangs yg dipilih
        $getJumlahTerjual = DB::table('detail_penjualans')
            ->select(DB::raw('SUM(jumlah) as jumlah_terjual'))
            ->where('barang_id', $id)
            ->first();

        $getJumlahReturn = DB::table('return_barangs')
            ->select(DB::raw('SUM(jumlah_return) as jumlah_return'))
            ->where('barang_id', $id)
            ->where('status', '0')
            ->first();


        $getJumlahHilang = DB::table('kehilangan_barangs')
            ->select(DB::raw('SUM(jumlah_hilang) as jumlah_hilang'))
            ->where('barang_id', $id)
            ->where('status', '0')
            ->first();

        $getLast = PembelianBarang::where('barang_id', $id)->orderBy('id', 'DESC')->first();  // utk mengambil dta barang yg terakhir, utk ambil harga dsb

        $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return; //pengurangan total barang yang dibeli dengen total barang yang terjual

        $no  = 1;
        $pdf = PDF::loadView('direktur.pembelian_barang.print_detail', compact('no', 'data', 'getJumlah', 'getJumlahTerjual', 'sisaStok', 'getLast', 'getJumlahReturn', 'getJumlahHilang'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('tabel_detail_pembelian.pdf');
    }
}
