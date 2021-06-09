<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nik');
            $table->string('nama_pegawai', 100);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama', 10);
            $table->string('tempat_lahir', 45);
            $table->date('tgl_lahir');
            $table->string('no_telp', 15);
            $table->text('alamat');
            $table->string('password', 64);
            $table->string('foto', 100)->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('asn');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
