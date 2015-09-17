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
}
