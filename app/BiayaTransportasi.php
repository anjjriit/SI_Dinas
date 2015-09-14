<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiayaTransportasi extends Model
{
    use SoftDeletes;

    protected $table = 'biaya_transport';
    protected $fillable = ['id_transportasi', 'id_kota_asal', 'id_kota_tujuan', 'harga'];

    protected $dates = ['deleted_at'];

    public function kotaAsal()
    {
        return $this->hasOne('App\Kota', 'kode', 'id_kota_asal');
    }

    public function kotaTujuan()
    {
        return $this->hasOne('App\Kota', 'kode', 'id_kota_tujuan');
    }

}
