<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $fillable = ['id_soal','isi_jawaban','is_correct'];
    protected $primaryKey = 'id_jawaban';

    public function soal()
    {
        return $this->belongsTo('App\Soal','id_soal','id_soal');
    }
}
