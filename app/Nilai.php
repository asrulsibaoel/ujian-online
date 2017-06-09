<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = ['id_ujian','nis','nilai'];
    protected $primaryKey = 'id_nilai';

    /*
    *	get the name of list siswa
    *	where participate to this ujian
     */
    public function siswa() {
    	return $this->belongsTo('App\Siswa','nis', 'nis');
    }

    /*
    *	get the name of mata ujian
     */
    public function ujian() {
    	return $this->belongsTo('App\Ujian','id_ujian','id_ujian');
    }
}
