<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id'); // relasikan barang_id
            $table->date('tanggal_pembelian');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('jumlah_beli');
            $table->integer('total');
            $table->unsignedBigInteger('user_id'); // relasikan barang_id
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barangs') // ambil primary key di tabel barang
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users') // ambil primary key di tabel barang
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
        Schema::dropIfExists('pembelian_barangs');
    }
}
