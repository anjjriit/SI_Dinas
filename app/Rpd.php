<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpd extends Model
{
    //dari tabel rpd
    protected $table = 'rpd';

    protected $fillable = [
        'nik',
        'kategori',
        'jenis_perjalanan',
        'tanggal_mulai',
        'tanggal_selesai',
        'kode_kota_asal',
        'kode_kota_tujuan',
        'sarana_penginapan',
        'keterangan',
        'status'
    ];

    public function peserta() {
        return $this->belongsToMany('App\Pegawai', 'peserta', 'id_rpd', 'nik_peserta')->withPivot('jenis_kegiatan', 'kode_kegiatan', 'kegiatan');
    }

    public function saranaTransportasi()
    {
        return $this->hasMany('App\SaranaTransportasi', 'id_rpd');
    }

    public function kotaAsal()
    {
        return $this->hasOne('App\Kota', 'kode', 'kode_kota_asal');
    }

    public function kotaTujuan()
    {
        return $this->hasOne('App\Kota', 'kode', 'kode_kota_tujuan');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nik');
    }

    public function actionHistory() {
        return $this->hasMany('App\ActionHistoryRpd', 'id_rpd');
    }
}

