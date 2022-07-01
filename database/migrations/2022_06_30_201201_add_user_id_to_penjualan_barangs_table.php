<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPenjualanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan_barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('kembalian')->nullable();

            $table->foreign('user_id')->references('id')->on('users') // ambil primary key di tabel users
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
        Schema::table('penjualan_barangs', function (Blueprint $table) {
            //
        });
    }
}
