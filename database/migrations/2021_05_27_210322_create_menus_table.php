<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_menu', 45)->nullable();
            $table->enum('level_menu', ['main menu', 'submenu']);
            $table->string('icon', 45)->nullable();
            $table->string('url', 45)->nullable();
            $table->integer('main_menu')->nullable();
            $table->tinyInteger('action')->comment('0 = tidak aktif, 1 = aktif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
