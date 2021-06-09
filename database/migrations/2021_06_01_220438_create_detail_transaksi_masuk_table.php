<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi_masuk', function (Blueprint $table) {
            $table->string('nama_logistik', 45);
            $table->string('satuan', 45);
            $table->integer('jumlah');
            $table->date('expired')->nullable();
            $table->tinyInteger('status');
            $table->bigInteger('logistik_id')->unsigned();
            $table->bigInteger('transaksi_masuk_id')->unsigned();
            $table->foreign('logistik_id')->references('id')->on('logistik');
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
        Schema::dropIfExists('detail_transaksi_masuk');
    }
}
