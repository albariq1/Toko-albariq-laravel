<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index()
    {
        return view('manajer_pemilik.pemasok.index');
    }
}
