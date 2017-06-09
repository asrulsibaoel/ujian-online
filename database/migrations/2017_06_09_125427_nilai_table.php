<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id_nilai')->unique();
            $table->string('nis', 64);
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->integer('id_ujian', false, true);
            $table->foreign('id_ujian')->references("id_ujian")->on("ujian")->onDelete("cascade");
            $table->double('nilai', 3, 2);
            $table->timestamps();

            $table->index(['id_nilai', 'nis', 'id_ujian']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nilai');
    }
}
