<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{

    public function index()
    {
        $detail = DB::table('penjualan_barangs')
            ->select(DB::raw('penjualan_barangs.*, users.name, pelanggans.nama_pelanggan'))
            ->join('users', 'users.id', 'penjualan_barangs.user_id')
            ->leftJoin('pelanggans', 'pelanggans.id', 'penjualan_barangs.pelanggan_id')
            ->orderBy('kode_penjualan', 'DESC')
            ->get();

        $grandTotal = DB::table('penjualan_barangs')
            ->select(DB::raw('penjualan_barangs.*, SUM(grand_total) as totalBelanjaan '))
            ->join('detail_penjualans', 'detail_penjualans.penjualan_id', 'penjualan_barangs.id')
            ->where('detail_penjualans.status', '1')
            ->first();
        $data = [
            'detail' => $detail,
            'grandTotal' => $grandTotal
        ];
        return view('manajer_pemilik.penjualan.index', compact('data'));
    }
}
