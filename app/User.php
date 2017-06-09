<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_siswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_siswa','fullname', 'id', 'password','pwd', 'id_kelas', 'id_jurusan', 'status'];
    protected $primaryKey = 'id_siswa';

    /*
    * user has kelas and jurusan
     */
    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas', 'id_kelas');
    }
    public function jurusan() {
        return $this->belongsTo('App\Jurusan', 'id_jurusan', 'id_jurusan');
    }
}
