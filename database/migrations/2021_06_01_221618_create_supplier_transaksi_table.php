<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_transaksi', function (Blueprint $table) {
            $table->integer('supplier_id')->unsigned();
            $table->bigInteger('transaksi_masuk_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('supplier');
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
        Schema::dropIfExists('supplier_transaksi');
    }
}
