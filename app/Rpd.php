<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpd extends Model
{
    //dari tabel rpd
    protected $table = 'rpd';

    protected $fillable = [
        'kode',
        'nik',
        'kategori',
        'jenis_perjalanan',
        'tanggal_mulai',
        'tanggal_selesai',
        'lama_hari',
        'kode_kota_asal',
        'kode_kota_tujuan',
        'id_penginapan',
        'keterangan',
        'status',
        'akomodasi_awal'
    ];

    public function peserta() {
        return $this->belongsToMany('App\Pegawai', 'kegiatan', 'id_rpd', 'nik_peserta')->groupBy('nik_peserta');
    }

    public function kegiatan() {
        return $this->hasMany('App\Kegiatan', 'id_rpd');
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

    public function saranaTransportasi()
    {
        return $this->belongsToMany('App\Transportasi', 'sarana_transportasi', 'id_rpd', 'id_transportasi');
    }

    public function saranaPenginapan()
    {
        return $this->hasOne('App\Penginapan', 'id', 'id_penginapan');
    }
}

