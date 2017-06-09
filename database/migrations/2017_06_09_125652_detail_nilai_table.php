<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_nilai', function (Blueprint $table) {
            $table->increments('id_detailnilai')->unique();
            $table->integer('id_nilai')->unsigned();
            $table->foreign('id_nilai')->references('id_nilai')->on('nilai')->onDelete('cascade');
            $table->integer('id_soal')->unsigned();
            $table->foreign('id_soal')->references('id_soal')->on('soal')->onDelete('cascade');
            $table->integer('id_jawaban')->unsigned();
            $table->foreign('id_jawaban')->references('id_jawaban')->on('jawaban')->onDelete('cascade');
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
        Schema::drop('detail_nilai');
    }
}
