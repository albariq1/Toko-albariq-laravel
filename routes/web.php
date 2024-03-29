<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// saat routing dipanggil, lakukan/panggil fungsi apa yang akan di eksekusi oleh routing tsbt.
// default routing ditandai dengan tanda /
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('login');
});


Auth::routes();

// menampilkan 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'index'])->name('tabel_barang');
Route::get('/tabel_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'index'])->name('tabel_pemasok');
Route::get('/tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'index'])->name('tabel_user');
Route::get('/tabel_return', [App\Http\Controllers\Manajer\ReturnBarangController::class, 'index'])->name('tabel_return');
Route::get('/tabel_pembelian_barang', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'index'])->name('tabel_pembelian_barang');
Route::get('/tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'index'])->name('tabel_pelanggan');
Route::get('/transaksi', [App\Http\Controllers\Manajer\TransaksiController::class, 'index'])->name('transaksi');
Route::get('/setting', [App\Http\Controllers\SetingController::class, 'profile'])->name('setting');
Route::get('/tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'index'])->name('tabel_kategori');
Route::get('/tabel_kehilangan', [App\Http\Controllers\Manajer\KehilanganBarangController::class, 'index'])->name('tabel_kehilangan');
Route::get('/tabel_history', [App\Http\Controllers\Manajer\HistoryController::class, 'index'])->name('tabel_history');


// mengirim data untuk User
Route::post('/store_tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'store'])->name('store_tabel_user');
Route::post('/update_tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'update'])->name('update_tabel_user');
Route::post('/destroy_tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'destroy'])->name('destroy_tabel_user');
Route::get('/download_user', [App\Http\Controllers\Manajer\UserController::class, 'printUser'])->name('download_user');

// mengirim data untuk Kategori
Route::post('/store_tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'store'])->name('store_tabel_kategori');
Route::post('/update_tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'update'])->name('update_tabel_kategori');
Route::post('/destroy_tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'destroy'])->name('destroy_tabel_kategori');
Route::get('/download_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'printKategori'])->name('download_kategori');

// mengirim data Pemasok
Route::post('/store_tabel_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'store'])->name('store_tabel_pemasok');
Route::post('/update_tabel_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'update'])->name('update_tabel_pemasok');
Route::post('/destroy_tabel_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'destroy'])->name('destroy_tabel_pemasok');
Route::get('/download_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'printPemasok'])->name('download_pemasok');

// mengirim data pelanggan
Route::post('/store_tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'store'])->name('store_tabel_pelanggan');
Route::post('/update_tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'update'])->name('update_tabel_pelanggan');
Route::post('/destroy_tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'destroy'])->name('destroy_tabel_pelanggan');
Route::get('/download_pelanggan', [App\Http\Controllers\Manajer\pelangganController::class, 'printPelanggan'])->name('download_pelanggan');

// mengirim data barang
Route::post('/store_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'store'])->name('store_tabel_barang');
Route::post('/update_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'update'])->name('update_tabel_barang');
Route::post('/destroy_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'destroy'])->name('destroy_tabel_barang');
Route::get('/download_barang', [App\Http\Controllers\Manajer\BarangController::class, 'printBarang'])->name('download_barang');

// mengirim data pembelian 
Route::get('/detail_tabel_pembelian_barang/{id}', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'detail'])->name('detail_tabel_pembelian_barang');
Route::post('/store_tabel_pembelian_barang', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'store'])->name('store_tabel_pembelian_barang');
Route::get('/barcode_barang', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'cetakBarcode'])->name('barcode_barang');
Route::get('/download_stok', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'printPembelian'])->name('download_stok');
Route::get('/download_detail_pembelian', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'printPembelianBarang'])->name('download_detail_pembelian');
// Route::post('/update_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'update'])->name('update_tabel_barang');
// Route::post('/destroy_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'destroy'])->name('destroy_tabel_barang');

// mengirim data kasir
Route::get('/kasir/transaksi', [App\Http\Controllers\Kasir\TransaksiController::class, 'index'])->name('kasir.transaksi');
Route::post('/kasir/store-transaksi', [App\Http\Controllers\Kasir\TransaksiController::class, 'store'])->name('kasir.store-transaksi');
Route::post('/kasir/store-penjualan', [App\Http\Controllers\Kasir\TransaksiController::class, 'store_penjualan'])->name('kasir.store-penjualan');
Route::get('/kasir/history-transaksi', [App\Http\Controllers\Kasir\TransaksiController::class, 'history_transaksi'])->name('kasir.history-transaksi');
Route::get('/kasir/cetak-invoice/{id}', [App\Http\Controllers\Kasir\TransaksiController::class, 'cetak_invoice'])->name('kasir.cetak-invoice');
Route::get('/kasir/download_rekap', [App\Http\Controllers\Kasir\TransaksiController::class, 'printtransaksi'])->name('download_rekap');

// seting profile
Route::post('/update-setting', [App\Http\Controllers\SetingController::class, 'updateprofile'])->name('update-profile');
Route::post('/update-foto', [App\Http\Controllers\SetingController::class, 'updatefoto'])->name('update-foto');

// return 
Route::post('/store-tabel_return', [App\Http\Controllers\Manajer\ReturnBarangController::class, 'store'])->name('store_tabel_return');
Route::get('/update-status_return/{id}', [App\Http\Controllers\Manajer\ReturnBarangController::class, 'updateStatus'])->name('update_status_return');
Route::post('/destroy_tabel_return', [App\Http\Controllers\Manajer\ReturnBarangController::class, 'destroy'])->name('destroy_tabel_return');
Route::get('/download_return', [App\Http\Controllers\Manajer\ReturnBarangController::class, 'printReturn'])->name('download_return');

// penjualan barang
Route::get('/tabel_penjualan', [App\Http\Controllers\Manajer\PenjualanBarangController::class, 'index'])->name('tabel_penjualan');
Route::get('/laba_rugi', [App\Http\Controllers\Manajer\PenjualanBarangController::class, 'lap_laba_rugi'])->name('laba_rugi');
Route::get('/download_labarugi', [App\Http\Controllers\Manajer\PenjualanBarangController::class, 'printlabarugi'])->name('download_labarugi');
Route::get('/download_labarugi_langsung', [App\Http\Controllers\Manajer\PenjualanBarangController::class, 'printlabarugilangsung'])->name('download_labarugi_langsung');


// Kehilangan barang
Route::post('/destroy_tabel_kehilangan', [App\Http\Controllers\Manajer\KehilanganBarangController::class, 'destroy'])->name('destroy_tabel_kehilangan');
Route::post('/store-tabel_kehilangan', [App\Http\Controllers\Manajer\KehilanganBarangController::class, 'store'])->name('store_tabel_kehilangan');
Route::get('/update-status_kehilangan/{id}', [App\Http\Controllers\Manajer\KehilanganBarangController::class, 'updateStatus'])->name('update_status_hilang');
Route::get('/download_kehilangan', [App\Http\Controllers\Manajer\KehilanganBarangController::class, 'printKehilangan'])->name('download_kehilangan');

// history
Route::get('/download_history', [App\Http\Controllers\Manajer\HistoryController::class, 'printHistory'])->name('download_history');
