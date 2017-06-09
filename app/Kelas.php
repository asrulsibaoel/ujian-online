<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tbl_kelas';
    protected $fillable = ['id_kelas', 'kelas', 'id_user'];
    protected $primaryKey = 'id_kelas';

    public function kelas()
    {
        return $this->kelas;
    }

    public function idKelas()
    {
        return $this->id_kelas;
    }
}
