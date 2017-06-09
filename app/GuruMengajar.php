<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruMengajar extends Model
{
    protected $table = 'guru_mengajar';
    protected $fillable = ['nip','id_mapel','keterangan'];
    protected $primaryKey = 'id_pengajar';

    public function guru()
    {
        return $this->belongsTo('App\Guru','nip','nip');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Mapel','id_mapel','id_mapel');
    }
}
