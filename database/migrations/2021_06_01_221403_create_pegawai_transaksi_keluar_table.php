<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTransaksiKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_transaksi_keluar', function (Blueprint $table) {
            $table->tinyInteger('action');
            $table->bigInteger('pegawai_id')->unsigned();
            $table->bigInteger('transaksi_keluar_id')->unsigned();
            $table->foreign('pegawai_id')->references('id')->on('pegawai');
            $table->foreign('transaksi_keluar_id')->references('id')->on('transaksi_keluar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_transaksi_keluar');
    }
}
