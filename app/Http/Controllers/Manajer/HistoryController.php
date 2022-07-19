<?php

namespace App\Http\Controllers\manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class HistoryController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d H:i:s');
        $history = DB::table('riwayat_logins')
            ->select('riwayat_logins.*', 'users.name')
            ->join('users', 'users.id', 'riwayat_logins.user_id')
            ->orderBy('last_login_at', 'DESC')
            ->get();

        return view('manajer_pemilik.history.index', compact('history'));
    }
    public function printHistory(Request $request)
    {
        $datahistory = DB::table('riwayat_logins')
            ->select('riwayat_logins.*', 'users.name')
            ->join('users', 'users.id', 'riwayat_logins.user_id')
            ->orderBy('last_login_at', 'DESC')
            ->get();
        $no  = 1;
        $pdf = PDF::loadView('manajer_pemilik.history.print', compact('datahistory', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('tabel_pemasok.pdf');
    }
}
