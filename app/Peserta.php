<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $fillable = ['id_rpd', 'nik_peserta', 'jenis_kegiatan', 'kode_kegiatan', 'kegiatan'];
}
