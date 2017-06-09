<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailNilai extends Model
{
    protected $table = 'detail_nilai';
    protected $fillable = ['id_nilai','id_soal','id_jawaban'];
    protected $primaryKey = 'id_detailnilai';

    public function nilai()
    {
        return $this->belongsTo('App\Nilai','id_nilai','id_nilai');
    }

    public function soal()
    {
        return $this->belongsTo('App\Soal','id_soal','id_soal');
    }

    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban','id_jawaban','id_jawaban');
    }
}
