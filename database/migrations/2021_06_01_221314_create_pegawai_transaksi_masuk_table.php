<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTransaksiMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_transaksi_masuk', function (Blueprint $table) {
            $table->tinyInteger('action');
            $table->bigInteger('pegawai_id')->unsigned();
            $table->bigInteger('transaksi_masuk_id')->unsigned();
            $table->foreign('pegawai_id')->references('id')->on('pegawai');
            $table->foreign('transaksi_masuk_id')->references('id')->on('transaksi_masuk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_transaksi_masuk');
    }
}
