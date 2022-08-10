<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PenjualanBarangController extends Controller
{

    public function index()
    {
        $today = date('Y-m-d');
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
        $detailharian = DB::table('penjualan_barangs')
            ->select(DB::raw('penjualan_barangs.*, users.name, pelanggans.nama_pelanggan'))
            ->join('users', 'users.id', 'penjualan_barangs.user_id')
            ->leftJoin('pelanggans', 'pelanggans.id', 'penjualan_barangs.pelanggan_id')
            ->where('tanggal_transaksi', $today)
            ->orderBy('kode_penjualan', 'DESC')
            ->get();
        $data = [
            'detail' => $detail,
            'grandTotal' => $grandTotal
        ];
        $dataharian = [
            'detail' => $detailharian,
            'grandTotal' => $grandTotal
        ];
        return view('manajer_pemilik.penjualan.index', compact('data', 'dataharian'));
    }

    public function lap_laba_rugi(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = date("Y");
        $today = date('Y-m-d');


        $dataperhari = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%d %M %Y %H:%i:%s') as jual_tanggal,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon) AS untung_bersih, barang_id FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE penjualan_barangs.tanggal_transaksi = '$today' ");

        $jumlahperhari = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%M %Y') AS bulan,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,SUM(((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon)) AS total FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE penjualan_barangs.tanggal_transaksi = '$today'");

        $data = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%d %M %Y %H:%i:%s') as jual_tanggal,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon) AS untung_bersih, barang_id FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE DATE_FORMAT(detail_penjualans.created_at,'%M %Y')='$bulan $tahun'");

        $jumlah = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%M %Y') AS bulan,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,SUM(((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon)) AS total FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE DATE_FORMAT(detail_penjualans.created_at,'%M %Y')='$bulan $tahun'");

        $result = array(
            'data' => $data,
            'jumlah' => $jumlah
        );
        return view('manajer_pemilik.laba_rugi.index', compact('result', 'bulan'));

        // return view('manajer_pemilik.penjualan_barang.cetak_laba', compact('result'));

        dd($result);
    }
    public function printlabarugi(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = date("Y");
        $today = date('Y-m-d');


        $dataperhari = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%d %M %Y %H:%i:%s') as jual_tanggal,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon) AS untung_bersih, barang_id FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE penjualan_barangs.tanggal_transaksi = '$today' ");

        $jumlahperhari = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%M %Y') AS bulan,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,SUM(((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon)) AS total FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE penjualan_barangs.tanggal_transaksi = '$today'");

        $data = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%d %M %Y %H:%i:%s') as jual_tanggal,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon) AS untung_bersih, barang_id FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE DATE_FORMAT(detail_penjualans.created_at,'%M %Y')='$bulan $tahun'");

        $jumlah = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%M %Y') AS bulan,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,SUM(((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon)) AS total FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE DATE_FORMAT(detail_penjualans.created_at,'%M %Y')='$bulan $tahun'");

        $result = array(
            'data' => $data,
            'jumlah' => $jumlah
        );
        $pdf = PDF::loadView('manajer_pemilik.laba_rugi.print', compact('result', 'bulan'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('tabel_LabaRugi.pdf');


        // return view('manajer_pemilik.laba_rugi.index', compact('result', 'bulan'));

        // return view('manajer_pemilik.penjualan_barang.cetak_laba', compact('result'));

        dd($result);
    }
    public function printlabarugilangsung(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = date("Y");
        $today = date('Y-m-d');


        $dataperhari = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%d %M %Y %H:%i:%s') as jual_tanggal,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon) AS untung_bersih, barang_id FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE penjualan_barangs.tanggal_transaksi = '$today' ");

        $jumlahperhari = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%M %Y') AS bulan,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,SUM(((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon)) AS total FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE penjualan_barangs.tanggal_transaksi = '$today'");

        $data = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%d %M %Y %H:%i:%s') as jual_tanggal,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon) AS untung_bersih, barang_id FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE DATE_FORMAT(detail_penjualans.created_at,'%M %Y')='$bulan $tahun'");

        $jumlah = DB::select("SELECT DATE_FORMAT(detail_penjualans.created_at,'%M %Y') AS bulan,harga_pokok,harga_jual,(harga_jual-harga_pokok) AS keunt,jumlah,jual_diskon,SUM(((harga_jual-harga_pokok)*jumlah)-(jumlah*jual_diskon)) AS total FROM penjualan_barangs JOIN detail_penjualans ON detail_penjualans.penjualan_id=penjualan_barangs.id WHERE DATE_FORMAT(detail_penjualans.created_at,'%M %Y')='$bulan $tahun'");

        $result = array(
            'data' => $data,
            'jumlah' => $jumlah
        );
        $pdf = PDF::loadView('manajer_pemilik.laba_rugi.print', compact('result', 'bulan'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('tabel_LabaRugi.pdf');


        // return view('manajer_pemilik.laba_rugi.index', compact('result', 'bulan'));

        // return view('manajer_pemilik.penjualan_barang.cetak_laba', compact('result'));

        dd($result);
    }
}
