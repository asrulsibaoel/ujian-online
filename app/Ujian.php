<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';
    protected $fillable = ['id_pengajar','nama_ujian','tanggal','durasi','keterangan'];
    protected $primaryKey = 'id_ujian';

    /*
    *   get data soal
     */
    public function guruMengajar() {
        return $this->belongsTo('App\GuruMengajar','id_soal','id_soal');
    }

}
