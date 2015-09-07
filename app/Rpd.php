<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpd extends Model
{
    protected $table = 'rpd';
    protected $fillable = ['nama_kota', 'tanggal_mulai', 'tanggal_selesai'];

    public $primaryKey = 'id';

    public function kota()
    {
        return $this->hasOne('App\Kota', 'kode', 'kode_kota_tujuan');
    }
}

