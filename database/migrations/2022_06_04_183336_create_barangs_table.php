<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->unsignedBigInteger('kategori_id'); // relasikan katagori_id
            $table->unsignedBigInteger('pemasok_id'); // relasikan katagori_id
            $table->string('barcode')->nullable();
            // $table->integer('stok');
            $table->enum('satuan', ['Pcs', 'Kg']);
            // $table->double('harga_jual');

            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris') // ambil primary key di tabel kategoris
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('pemasok_id')->references('id')->on('pemasoks') // ambil primary key di tabel pemasoks
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
        Schema::dropIfExists('barangs');
    }
}
