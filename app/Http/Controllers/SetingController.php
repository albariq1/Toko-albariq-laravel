<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SetingController extends Controller
{
    public function profile()
    {
        $data = User::find(Auth::user()->id);
        return view('auth.profile', compact('data'));
    }

    public function updateProfile(Request $request)
    {

        User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return redirect('setting');
    }

    public function updatefoto(Request $request)
    {
        $user = User::find(Auth::user()->id);
        // jika user upload gambar
        if ($request->file('foto')) {
            // periksa apakah field foto pd user terisi atau tidak
            // jika terisi, maka hapus foto lamanya di penyimpanan
            if ($user->foto) {
                Storage::delete();
            }

            // upload file yang baru
            $pathFoto = $request->file('foto')->store('user-images');
            $user->update([
                'foto' => $pathFoto
            ]);
        }
        return redirect('setting');
    }
}
