<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpd extends Model
{
    //dari tabel rpd
    protected $table = 'rpd';
    protected $fillable = ['nik','kategori','jenis_perjalanan','tanggal_mulai', 'tanggal_selesai','kode_kota_asal','kode_kota_tujuan','sarana_penginapan', 'keterangan','status'];

    public $primaryKey = 'id';


    //relasi one to many dengan kota
    // public function kota(){

    //     return $this->belongsTo('App\kota','kode_kota_tujuan');
    // }
    
    public function kota()
    {
        return $this->hasOne('App\Kota', 'kode', 'kode_kota_tujuan');
    }
}

