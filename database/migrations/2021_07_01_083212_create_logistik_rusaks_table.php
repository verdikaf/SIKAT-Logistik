<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogistikRusaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistik_rusak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jumlah')->nullable();
            $table->bigInteger('logistik_id')->unsigned();
            $table->foreign('logistik_id')->references('id')->on('logistik')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistik_rusaks');
    }
}
