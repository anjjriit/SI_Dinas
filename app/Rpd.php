<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpd extends Model
{
    protected $table = 'rpd';
    protected $fillable = ['nik', 'kategori', 'jenis_perjalanan', 'tanggal_mulai', 'tanggal_selesai', 'kode_kota_asal', 'kode_kota_tujuan', 'sarana_penginapan', 'keterangan', 'status'];

    public function peserta() {
        return $this->belongsToMany('App\Pegawai', 'peserta', 'id_rpd', 'nik_peserta')->withPivot('jenis_kegiatan', 'kode_kegiatan', 'kegiatan');
    }

    public function saranaTransportasi() {
        return $this->hasMany('App\SaranaTransportasi', 'id_rpd');
    }
}
