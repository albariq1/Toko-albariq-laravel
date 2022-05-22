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

    // menyimpan data ke tabel users
    public function store(Request $request)
    {
        // validasi
        // $request->validate(
        //     [
        //         'email' => 'required|email',
        //         'name' => 'required|min:3',
        //         'no_hp' => 'required|min:11|max:15',
        //         'password' => 'required',
        //         'alamat' => 'required',
        //         'role' => 'required'


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

            if ($store) {
                return redirect('tabel_user');
            } else {
                return redirect('tabel_user');
            }
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }



    // menampilkan form edit
    public function edit()
    {
    }
}
