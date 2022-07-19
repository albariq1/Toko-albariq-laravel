<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PemasokController extends Controller
{
    public function index()
    {
        $data = Pemasok::all();
        if (Auth::user()->role == 'Direktur') {
            return view('direktur.pemasok.index', compact('data'));
        } else if (Auth::user()->role == 'Sekretaris') {
            return view('direktur.pemasok.index', compact('data'));
        } else if (Auth::user()->role == 'Keuangan') {
            return view('direktur.pemasok.index', compact('data'));
        } else if (Auth::user()->role == 'Staf Gudang') {
            return view('manajer_pemilik.pemasok.index', compact('data'));
        } else if (Auth::user()->role == 'Admin') {
            return view('manajer_pemilik.pemasok.index', compact('data'));
        }
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
            $store = Pemasok::create(
                [
                    'nama_pemasok' => $request->nama_pemasok,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp
                ]
            );

            return redirect('tabel_pemasok')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_pemasok')->with([
                'failed' => 'Data Gagal Ditambah! Karena' . $error->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'nama_pemasok' => 'required',
        //     'alamat' => 'required',
        //     'no_hp' => 'required'
        // ]);

        try {
            //proses update data ke tabel
            // eloquent
            // ambil data user berdasarkan id yang dikirim dari form
            $pemasok = Pemasok::find($request->id);

            $pemasok->update([
                'nama_pemasok' => $request->nama_pemasok,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp
            ]);

            return redirect('tabel_pemasok')->with([
                'success' => 'Data Berhasil DiEdit!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_pemasok')->with([
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
            Pemasok::destroy($request->id);

            return redirect('tabel_pemasok')->with([
                'success' => 'Data Berhasil DiHapus!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_pemasok')->with([
                'failed' => 'Data Gagal DiHapus!,Karena' . $error->getMessage()
            ]);
        }
    }
    public function printPemasok(Request $request)
    {
        $datapemasok = DB::table('pemasoks')
            ->select(DB::raw('pemasoks.*'))
            ->orderBy('nama_pemasok', 'ASC')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('direktur.pemasok.print', compact('datapemasok', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('tabel_pemasok.pdf');
    }
}
