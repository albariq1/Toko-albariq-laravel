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
        $tahun = date("Y");
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
        $return = DB::table('return_barangs')
            ->select(DB::raw('SUM(jumlah_return) as totalreturn'))
            ->where('status', '0')
            ->first();
        $labaGrafik = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%M') as bulan_jual, SUM(harga_pokok) as harga_pokok, SUM(harga_jual) as harga_jual, (SUM(harga_jual)-SUM(harga_pokok)) AS keunt, SUM(jumlah) AS jumlah, SUM(jual_diskon) as jual_diskon, ((SUM(harga_jual)-SUM(harga_pokok))*SUM(jumlah)) - (SUM(jumlah)*SUM(jual_diskon)) AS untung_bersih, barang_id FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE DATE_FORMAT(detail_penjualans.created_at,'%Y')='$tahun' GROUP BY DATE_FORMAT(detail_penjualans.created_at,'%M') ORDER BY detail_penjualans.created_at ASC");

        $categories = [];
        $series = [];
        foreach ($labaGrafik as $lg) {
            // menampilkan nama bulan sesuai isi utk di chart
            $categories[] = $lg->bulan_jual;

            // menampilkan nilai untung bersi sesuai isi utk di chart
            $series[] = (int)$lg->untung_bersih;
        }

        return view('home', compact('data', 'labakotor', 'totaltransaksi', 'series', 'categories', 'return'));
    }
}
