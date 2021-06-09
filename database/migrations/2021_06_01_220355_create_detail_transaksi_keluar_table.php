<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi_keluar', function (Blueprint $table) {
            $table->string('nama_logistik', 45);
            $table->string('satuan', 45);
            $table->integer('jumlah');
            $table->string('kondisi', 15)->nullable();
            $table->tinyInteger('status');
            $table->bigInteger('logistik_id')->unsigned();
            $table->bigInteger('transaksi_keluar_id')->unsigned();
            $table->foreign('logistik_id')->references('id')->on('logistik');
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
        Schema::dropIfExists('detail_transaksi_keluar');
    }
}
