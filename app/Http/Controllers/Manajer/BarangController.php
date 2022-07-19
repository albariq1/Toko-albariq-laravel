<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pemasok;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class BarangController extends Controller
{
    public function index()
    {
        $data = DB::table('barangs')
            ->select('barangs.*', 'kategoris.nama_katagori', 'pemasoks.nama_pemasok')
            ->join('kategoris', 'kategoris.id', 'barangs.kategori_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->get();

        $pemasok = Pemasok::orderBy('nama_pemasok', 'ASC')->get();   //ambil data pemasok
        $kategori = Kategori::orderBy('nama_katagori', 'ASC')->get();  //ambil data kategori

        // $data = Kategori::all();
        if (Auth::user()->role == 'Direktur') {
            return view('direktur.barang.index', compact('data', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Sekretaris') {
            return view('direktur.barang.index', compact('data', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Keuangan') {
            return view('direktur.barang.index', compact('data', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Staf Gudang') {
            return view('manajer_pemilik.barang.index', compact('data', 'pemasok', 'kategori'));
        } else if (Auth::user()->role == 'Admin') {
            return view('manajer_pemilik.barang.index', compact('data', 'pemasok', 'kategori'));
        }
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

        try {
            //proses input data ke tabel
            // eloquent
            $store = Barang::create(
                [
                    'pemasok_id' => $request->pemasok_id,
                    'kategori_id' => $request->kategori_id,
                    'nama_barang' => $request->nama_barang,
                    'barcode' => $request->barcode
                ]
            );

            return redirect('tabel_barang')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_barang')->with([
                'failed' => 'Data Gagal Ditambah! Karena' . $error->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'pemasok_id' => 'required',
            'kategori_id' => 'required',
            'nama_barang' => 'required',
            'barcode' => 'required'
        ]);

        try {
            //proses update data ke tabel
            // eloquent
            // ambil data user berdasarkan id yang dikirim dari form
            $barang = Barang::find($request->id);

            $barang->update([
                'pemasok_id' => $request->pemasok_id,
                'kategori_id' => $request->kategori_id,
                'nama_barang' => $request->nama_barang,
                'barcode' => $request->barcode
            ]);

            return redirect('tabel_barang')->with([
                'success' => 'Data Berhasil DiEdit!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_barang')->with([
                'failed' => 'Data Gagal DiEdit! Karena' . $error->getMessage()
            ]);
        }
    }

    // Hapus Data
    public function destroy(Request $request)
    {
        try {
            //proses update data ke tabel
            // eloquent
            // ambil data user berdasarkan id yang dikirim dari form
            Barang::destroy($request->id);

            return redirect('tabel_barang')->with([
                'success' => 'Data Berhasil DiHapus!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_barang')->with([
                'failed' => 'Data Gagal DiHapus!,Karena' . $error->getMessage()
            ]);
        }
    }
    public function printBarang(Request $request)
    {
        $databarang = DB::table('barangs')
            ->select('barangs.*', 'kategoris.nama_katagori', 'pemasoks.nama_pemasok')
            ->join('kategoris', 'kategoris.id', 'barangs.kategori_id')
            ->join('pemasoks', 'pemasoks.id', 'barangs.pemasok_id')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('direktur.barang.print', compact('databarang', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('tabel_barang.pdf');
    }
}
