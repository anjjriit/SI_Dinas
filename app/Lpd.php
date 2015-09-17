<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lpd extends Model
{
    protected $table = 'lpd';

    protected $fillable = [
        'kode',
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

    public function scopeMine($query)
    {
        return $query-where('nik', '=', auth()->user()->nik);
    }

    public function rpd()
    {
        return $this->belongsTo('App\Rpd', 'id_rpd', 'id');
    }
}
