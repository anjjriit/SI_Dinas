<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $fillable = ['id_rpd', 'nik_peserta', 'jenis_kegiatan', 'kode_kegiatan', 'kegiatan'];
}
