<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListSoal extends Model
{
    protected $table = 'tbl_listsoal';
    protected $fillable = ['id_soal','pertanyaan','a','b','c','d','jawaban','gambar'];

    protected $primaryKey = 'id_soal';

    /*
    * list soal belongs to 1 master soal
    * ex: 40 soal is list soal
    * 	  b. indonesia is master soal
    * 	  40 soal is belongs to b. indonesia
     */
    
    public function soal() {
    	return $this->belongsTo('app\Soal','id_soal','id_soal');
    }
}
