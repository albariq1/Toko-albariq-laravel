<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Exception;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return view('manajer_pemilik.kategori.index', compact('data'));
    }

    // menyimpan data ke tabel kategoris /menambahkan
    public function store(Request $request)
    {
        // // validasi
        // $request->validate([
        //     'nama_kategori' => 'required|unique:kategoris'
        // ]);

        try {
            //proses input data ke tabel
            // eloquent
            $store = Kategori::create(
                [
                    'nama_katagori' => $request->nama_katagori
                ]
            );

            return redirect('tabel_kategori')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_kategori')->with([
                'failed' => 'Data Gagal Ditambah! Karena' . $error->getMessage()
            ]);
        }
    }


    public function update(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        try {
            //proses update data ke tabel
            // eloquent
            // ambil data user berdasarkan id yang dikirim dari form
            $kategori = Kategori::find($request->id);

            $kategori->update([
                'nama_kategori' => $request->nama_kategori
            ]);

            return redirect('tabel_kategori')->with([
                'success' => 'Data Berhasil DiEdit!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_kategori')->with([
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
            Kategori::destroy($request->id);

            return redirect('tabel_kategori')->with([
                'success' => 'Data Berhasil DiHapus!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_kategori')->with([
                'failed' => 'Data Gagal DiHapus!,Karena' . $error->getMessage()
            ]);
        }
    }
}
