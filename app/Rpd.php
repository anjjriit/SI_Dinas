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

    public function scopeBacktoinitiator($query)
    {
        return $query->where('status','=','BACK TO INITIATOR');
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', '=', 'SUBMIT');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', '=', 'DRAFT');
    }

    public function scopeLog($query)
    {
        return $query->where('status', '!=', 'DRAFT');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', '=', 'APPROVED');
    }

    public function scopeMine($query)
    {
        return $query->where('nik', '=', auth()->user()->nik);
    }

    public function peserta() {
        return $this->belongsToMany('App\Pegawai', 'kegiatan', 'id_rpd', 'nik_peserta')->withTrashed()->groupBy('nik_peserta');
    }

    public function kegiatan() {
        return $this->hasMany('App\Kegiatan', 'id_rpd');
    }

    public function kotaAsal()
    {
        return $this->hasOne('App\Kota', 'kode', 'kode_kota_asal')->withTrashed();
    }

    public function kotaTujuan()
    {
        return $this->hasOne('App\Kota', 'kode', 'kode_kota_tujuan')->withTrashed();
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nik')->withTrashed();
    }

    public function actionHistory() {
        return $this->hasMany('App\ActionHistoryRpd', 'id_rpd');
    }

    public function saranaTransportasi()
    {
        return $this->belongsToMany('App\Transportasi', 'sarana_transportasi', 'id_rpd', 'id_transportasi')->withTrashed();
    }

    public function saranaPenginapan()
    {
        return $this->hasOne('App\Penginapan', 'id', 'id_penginapan')->withTrashed();
    }

    public function lpd()
    {
        return $this->hasOne('App\Lpd', 'id_rpd');
    }
}

