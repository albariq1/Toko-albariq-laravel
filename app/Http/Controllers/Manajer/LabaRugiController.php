<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function index()
    {
        return view('manajer_pemilik.laba_rugi.index');
    }
}
