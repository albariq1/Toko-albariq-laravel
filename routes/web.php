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
Route::get('/tabel_return', [App\Http\Controllers\Manajer\ReturnController::class, 'index'])->name('tabel_return');
Route::get('/tabel_penjualan', [App\Http\Controllers\Manajer\PenjualanController::class, 'index'])->name('tabel_penjualan');
Route::get('/tabel_pembelian_barang', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'index'])->name('tabel_pembelian_barang');
Route::get('/tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'index'])->name('tabel_pelanggan');
Route::get('/transaksi', [App\Http\Controllers\Manajer\TransaksiController::class, 'index'])->name('transaksi');
Route::get('/seting', [App\Http\Controllers\Manajer\SetingController::class, 'index'])->name('seting');
Route::get('/tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'index'])->name('tabel_kategori');


// mengirim data untuk User
Route::post('/store_tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'store'])->name('store_tabel_user');
Route::post('/update_tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'update'])->name('update_tabel_user');
Route::post('/destroy_tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'destroy'])->name('destroy_tabel_user');

// mengirim data untuk Kategori
Route::post('/store_tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'store'])->name('store_tabel_kategori');
Route::post('/update_tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'update'])->name('update_tabel_kategori');
Route::post('/destroy_tabel_kategori', [App\Http\Controllers\Manajer\KategoriController::class, 'destroy'])->name('destroy_tabel_kategori');

// mengirim data Pemasok
Route::post('/store_tabel_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'store'])->name('store_tabel_pemasok');
Route::post('/update_tabel_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'update'])->name('update_tabel_pemasok');
Route::post('/destroy_tabel_pemasok', [App\Http\Controllers\Manajer\PemasokController::class, 'destroy'])->name('destroy_tabel_pemasok');

// mengirim data pelanggan
Route::post('/store_tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'store'])->name('store_tabel_pelanggan');
Route::post('/update_tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'update'])->name('update_tabel_pelanggan');
Route::post('/destroy_tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'destroy'])->name('destroy_tabel_pelanggan');

// mengirim data barang
Route::post('/store_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'store'])->name('store_tabel_barang');
Route::post('/update_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'update'])->name('update_tabel_barang');
Route::post('/destroy_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'destroy'])->name('destroy_tabel_barang');

// mengirim data barang
Route::post('/store_tabel_pembelian_barang', [App\Http\Controllers\Manajer\PembelianBarangController::class, 'store'])->name('store_tabel_pembelian_barang');
// Route::post('/update_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'update'])->name('update_tabel_barang');
// Route::post('/destroy_tabel_barang', [App\Http\Controllers\Manajer\BarangController::class, 'destroy'])->name('destroy_tabel_barang');