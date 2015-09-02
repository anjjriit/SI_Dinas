<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBiayaPengeluaranStandard extends Model
{
    protected $table ='jenis_biaya_pengeluaran_standard';
    protected $fillable = ['nama_jenis', 'biaya'];

    public $primaryKey= 'kode';
}
