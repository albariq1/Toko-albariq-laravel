<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KehilanganBarang;
use App\Models\Pemasok;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class KehilanganBarangController extends Controller
{
    public function index()
    {
        $data = DB::table('kehilangan_barangs')
            ->select(DB::raw('kehilangan_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'kehilangan_barangs.barang_id')
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
            return view('direktur.kehilangan.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Sekretaris') {
            return view('direktur.kehilangan.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Keuangan') {
            return view('direktur.kehilangan.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Staf Gudang') {
            return view('manajer_pemilik.kehilangan.index', compact('data', 'barang', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Admin') {
            return view('manajer_pemilik.kehilangan.index', compact('data', 'barang', 'pemasok', 'kategori'));
        }

        // return view('manajer_pemilik.kehilangan.index', compact('data', 'barang', 'pemasok', 'kategori'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $total = $request->harga_beli * $request->jumlah_beli;

        // cek ktersediaan stok
        $getJumlah = DB::table('pembelian_barangs')
            ->select(DB::raw('SUM(jumlah_beli) as stok'))
            ->where('barang_id', $request->barang_id)
            ->first();

        // ambil jumlah (SUM) dari tabel detail_penjualans
        // berdasarkan id barangs yg dipilih
        $getJumlahTerjual = DB::table('detail_penjualans')
            ->select(DB::raw('SUM(jumlah) as jumlah_terjual'))
            ->where('barang_id', $request->barang_id)
            ->first();

        $getJumlahReturn = DB::table('return_barangs')
            ->select(DB::raw('SUM(jumlah_return) as jumlah_return'))
            ->where('barang_id', $request->barang_id)
            ->where('status', '0')
            ->first();

        $getJumlahHilang = DB::table('kehilangan_barangs')
            ->select(DB::raw('SUM(jumlah_hilang) as jumlah_hilang'))
            ->where('barang_id', $request->barang_id)
            ->where('status', '0')
            ->first();

        $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return - $getJumlahHilang->jumlah_hilang;

        if ($request->jumlah_return > $sisaStok) {
            return redirect()->back()->with([
                'failed' => 'Jumlah melebihi Stok Barang!'
            ]);
            die;
        }

        try {
            //proses input data ke tabel
            // eloquent
            $store = KehilanganBarang::create(
                [
                    'barang_id' => $request->barang_id,
                    'jumlah_hilang' => $request->jumlah_hilang,
                    'user_id' => Auth::user()->id
                ]
            );

            return redirect('tabel_kehilangan')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_kehilangan')->with([
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
            $store = KehilanganBarang::find($id)->update([
                'status' => '1',
                'tgl_update_status' => date('Y-m-d'),
            ]);

            return redirect('tabel_kehilangan')->with([
                'success' => 'Status Berhasil Diupdate!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_kehilangan')->with([
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
            KehilanganBarang::destroy($request->id);

            return redirect('tabel_kehilangan')->with([
                'success' => 'Data Berhasil DiHapus!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_kehilangan')->with([
                'failed' => 'Data Gagal DiHapus!,Karena' . $error->getMessage()
            ]);
        }
    }
    public function printKehilangan(Request $request)
    {
        $datakehilangan = DB::table('kehilangan_barangs')
            ->select(DB::raw('kehilangan_barangs.*, barangs.id as id_barang, barangs.nama_barang, barangs.barcode, barangs.satuan, pemasoks.nama_pemasok '))
            ->join('barangs', 'barangs.id', 'kehilangan_barangs.barang_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->orderBy('barangs.barcode', 'DESC')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('direktur.kehilangan.print', compact('datakehilangan', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('tabel_kehilangan.pdf');
    }
}
