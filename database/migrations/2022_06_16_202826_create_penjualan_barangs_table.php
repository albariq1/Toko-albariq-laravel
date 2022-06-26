<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penjualan')->nullable(); // kode invoice
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->double('potongan_harga')->nullable(); //potongan harga
            $table->double('grand_total_potongan')->nullable(); //grandtotal dapat potongan
            $table->double('grand_total')->nullable(); // grandtotal tanpa potongan
            $table->double('jumlah_bayar')->nullable(); // jumlah bayar
            $table->double('kembalian')->nullable(); // kembalian
            $table->date('tanggal_transaksi')->nullable(); // tanggal transaksi
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggans') //ambil primary key dari tabel user
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
        Schema::dropIfExists('penjualan_barangs');
    }
}
