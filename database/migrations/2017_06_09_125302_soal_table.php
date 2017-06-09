<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->increments('id_soal')->unique();
            $table->integer('id_ujian')->unsigned();
            $table->foreign('id_ujian')->references('id_ujian')->on('ujian')->onDelete('cascade');
            $table->text('isi_soal');
            $table->text('gambar');
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
        Schema::drop('soal');
    }
}
