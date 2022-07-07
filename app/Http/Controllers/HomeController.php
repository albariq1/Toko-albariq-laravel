<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = date('Y-m-d');
        $data = DB::table('detail_penjualans')
            ->select(DB::raw('SUM(jumlah) as barangterjual'))
            ->where('tanggal_transaksi', $today)
            ->where('status', '1')->first();
        $labakotor = DB::table('detail_penjualans')
            ->select(DB::raw('SUM(totalharga) as labakotor'))
            ->where('tanggal_transaksi', $today)
            ->where('status', '1')->first();
        // dd($data);
        $totaltransaksi = DB::table('penjualan_barangs')
            ->select(DB::raw('COUNT(kode_penjualan) as totaltransaksi'))
            ->where('tanggal_transaksi', $today)
            ->first();

        return view('home', compact('data', 'labakotor', 'totaltransaksi'));
    }
}
