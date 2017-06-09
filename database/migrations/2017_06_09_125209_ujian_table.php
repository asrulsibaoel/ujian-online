<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian', function (Blueprint $table) {
            $table->increments('id_ujian')->unique();
            $table->integer('id_pengajar')->unsigned();
            $table->foreign('id_pengajar')->references('id_pengajar')->on('guru_mengajar')->onDelete('cascade');
            $table->string('nama_ujian', 32);
            $table->date('tanggal');
            $table->time('durasi');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ujian');
    }
}
