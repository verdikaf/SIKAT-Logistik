<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogistiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistik', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_logistik', 45);
            $table->integer('stok');
            $table->text('deskripsi');
            $table->integer('stok_opname')->nullable();
            $table->integer('satuan_id')->unsigned();
            $table->integer('kategori_id')->unsigned();
            $table->foreign('satuan_id')->references('id')->on('satuan');
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistik');
    }
}
