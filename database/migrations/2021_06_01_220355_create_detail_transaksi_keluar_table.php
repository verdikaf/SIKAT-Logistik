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
            $table->tinyInteger('status')->comment('0: pending, 1: proses verifikasi, 2: sukses, dengan catatan, 3: sukses, 4: sukses, barang belum kembali');
            $table->string('keterangan', 45);
            $table->bigInteger('logistik_id')->unsigned();
            $table->bigInteger('transaksi_keluar_id')->unsigned();
            $table->foreign('logistik_id')->references('id')->on('logistik')->onDelete('cascade');
            $table->foreign('transaksi_keluar_id')->references('id')->on('transaksi_keluar')->onDelete('cascade');
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
