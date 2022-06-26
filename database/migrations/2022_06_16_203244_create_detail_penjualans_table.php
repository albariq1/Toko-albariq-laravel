<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            // $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->integer('jumlah');
            $table->double('totalharga');
            $table->enum('status', ['0', '1']); // 0 => masih di keranjang, 1 => sudah checkout
            $table->date('tanggal_transaksi')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barangs') // ambil primarry key di tabel user
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('penjualan_id')->references('id')->on('penjualan_barangs') // ambil primarry key di tabel penjualan
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // $table->foreign('pelanggan_id')->references('id')->on('pelanggans') // ambil primarry key di pelanggan
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users') // ambil primarry key di user
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
