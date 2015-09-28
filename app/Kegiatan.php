<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $fillable = ['id_rpd', 'nik_peserta', 'jenis_kegiatan', 'kode_kegiatan', 'kegiatan'];

    public function project()
    {
        return $this->hasOne('App\Project', 'kode', 'kode_kegiatan')->withTrashed();
    }

    public function prospek()
    {
        return $this->hasOne('App\Prospek', 'kode', 'kode_kegiatan')->withTrashed();
    }

    public function pelatihan()
    {
        return $this->hasOne('App\Pelatihan', 'kode', 'kode_kegiatan')->withTrashed();
    }

    public function peserta()
    {
        return $this->hasOne('App\Pegawai', 'nik', 'nik_peserta')->withTrashed();
    }
}
