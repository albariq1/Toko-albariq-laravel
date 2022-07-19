<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;


class PelangganController extends Controller
{
    public function index()
    {
        $data = Pelanggan::all();

        if (Auth::user()->role == 'Direktur') {
            return view('direktur.pelanggan.index', compact('data'));
        } else if (Auth::user()->role == 'Sekretaris') {
            return view('manajer_pemilik.pelanggan.index', compact('data'));
        } else if (Auth::user()->role == 'Keuangan') {
            return view('direktur.pelanggan.index', compact('data'));
        } else if (Auth::user()->role == 'Staf Gudang') {
            return view('manajer_pemilik.pelanggan.index', compact('data'));
        } else if (Auth::user()->role == 'Admin') {
            return view('manajer_pemilik.pelanggan.index', compact('data'));
        }
        // return view('manajer_pemilik.pelanggan.index', compact('data'));
    }

    public function store(Request $request)
    {
        // validasi
        // $request->validate(
        //     [
        //         'email' => 'required|email|unique:users',
        //         'name' => 'required|min:3',
        //         'no_hp' => 'required|min:11|max:15',
        //         'password' => 'required',
        //         'alamat' => 'required',
        //         'role' => 'required',


        //     ]
        // );

        try {
            //proses input data ke tabel
            // eloquent
            $store = Pelanggan::create(
                [
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp
                ]
            );

            return redirect('tabel_pelanggan')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_pelanggan')->with([
                'failed' => 'Data Gagal Ditambah! Karena' . $error->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        try {
            //proses update data ke tabel
            // eloquent
            // ambil data user berdasarkan id yang dikirim dari form
            $pemasok = Pelanggan::find($request->id);

            $pemasok->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp
            ]);

            return redirect('tabel_pelanggan')->with([
                'success' => 'Data Berhasil DiEdit!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_pelanggan')->with([
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
            Pelanggan::destroy($request->id);

            return redirect('tabel_pelanggan')->with([
                'success' => 'Data Berhasil DiHapus!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_pelanggan')->with([
                'failed' => 'Data Gagal DiHapus!,Karena' . $error->getMessage()
            ]);
        }
    }
    public function printPelanggan(Request $request)
    {
        $datapelanggan = DB::table('pelanggans')
            ->select(DB::raw('pelanggans.*'))
            ->orderBy('nama_pelanggan', 'ASC')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('direktur.pelanggan.print', compact('datapelanggan', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('tabel_pelanggan.pdf');
    }
}
