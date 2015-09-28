<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $fillable = ['id_lpd', 'tanggal', 'id_tipe', 'keterangan', 'struk', 'biaya'];

    public function lpd()
    {
        return $this->belongsTo('App\Lpd', 'id_lpd');
    }

    public function personel()
    {
        return $this->belongsToMany('App\Pegawai', 'personel_pengeluaran', 'id_pengeluaran', 'nik')->withTrashed();
    }

    public function tipe()
    {
        return $this->belongsTo('App\TipePengeluaran', 'id_tipe')->withTrashed();
    }
}
