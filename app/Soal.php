<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'id_soal';
    protected $fillable = ['id_ujian','isi_soal','gambar'];

    public function ujian()
    {
        return $this->belongsTo('App\Ujian','id_ujian', 'id_ujian');
    }
}
