<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('manajer_pemilik.user.index', compact('data'));
    }

    // menyimpan data ke tabel users /menambahkan
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
            $store = User::create(
                [
                    'email' => $request->email,
                    'name' => $request->name,
                    'no_hp' => $request->no_hp,
                    'password' => Hash::make($request->password),
                    'alamat' => $request->alamat,
                    'role' => $request->role
                ]
            );

            return redirect('tabel_user')->with([
                'success' => 'Data Berhasil Ditambah!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_user')->with([
                'failed' => 'Data Gagal Ditambah! Karena' . $error->getMessage()
            ]);
        }
    }



    public function update(Request $request)
    {
        // dd($request->all());
        // // validasi
        // $request->validate(
        //     [
        //         'email' => 'required|email|unique:users',
        //         'name' => 'required|min:3',
        //         'no_hp' => 'required|min:11|max:15',
        //         'alamat' => 'required',
        //         'role' => 'required',


        //     ]
        // );

        try {
            //proses update data ke tabel
            // eloquent
            // ambil data user berdasarkan id yang dikirim dari form
            $user = User::find($request->id);

            // cek apakah inputan password diisi atau tidak
            if ($request->password) {
                $newPassword = Hash::make($request->password);
            } else {
                $newPassword = $user->password;
            }

            $user->update([
                'name' => $request->name,
                'No_hp' => $request->no_hp,
                'role' => $request->role,
                'alamat' => $request->alamat,
                'password' => $newPassword
            ]);

            return redirect('tabel_user')->with([
                'success' => 'Data Berhasil DiEdit!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_user')->with([
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
            User::destroy($request->id);

            return redirect('tabel_user')->with([
                'success' => 'Data Berhasil DiHapus!'
            ]);
        } catch (Exception $error) {
            return redirect('tabel_user')->with([
                'failed' => 'Data Gagal DiHapus!,Karena' . $error->getMessage()
            ]);
        }
    }
}
