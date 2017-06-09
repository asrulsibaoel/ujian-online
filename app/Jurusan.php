<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['nama_jurusan'];
    protected $primaryKey = 'id_jurusan';

    public function jurusan()
    {
        return $this->nama_jurusan;
    }

    public function idJurusan()
    {
        return $this->id_jurusan;
    }
}
