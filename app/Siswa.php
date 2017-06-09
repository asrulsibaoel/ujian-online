<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nis', 'nama_siswa', 'password', 'alamat', 'id_jurusan', 'semester', 'kelas'];
    protected $primaryKey = 'nis';

    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan','id_jurusan', 'id_jurusan');
    }
}
