<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lpd extends Model
{
    protected $table = 'lpd';

    protected $fillable = [
        'kode',
        'nik',
        'id_rpd',
        'tanggal_laporan',
        'total_pengeluaran',
        'reimburse',
        'status'
    ];

    public function scopeLog($query)
    {
        return $query->where('status', '!=', 'DRAFT');
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', '=', 'SUBMIT');
    }

    public function scopeMine($query)
    {
        return $query->where('nik', '=', auth()->user()->nik);
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nik');
    }

    public function rpd()
    {
        return $this->belongsTo('App\Rpd', 'id_rpd', 'id');
    }
}
