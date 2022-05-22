<?php

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
Route::get('/tabel_pembelian', [App\Http\Controllers\Manajer\PembelianController::class, 'index'])->name('tabel_pembelian');
Route::get('/tabel_pelanggan', [App\Http\Controllers\Manajer\PelangganController::class, 'index'])->name('tabel_pelanggan');
Route::get('/transaksi', [App\Http\Controllers\Manajer\TransaksiController::class, 'index'])->name('transaksi');


// mengirim data atau method post
Route::post('/store_tabel_user', [App\Http\Controllers\Manajer\UserController::class, 'store'])->name('store_tabel_user');
