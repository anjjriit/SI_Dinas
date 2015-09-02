<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = 'pelatihan';
    protected $fillable = ['nama_pelatihan','nama_lembaga','tanggal_mulai','tanggal_selesai','alamat'];

    public $primaryKey = 'kode';
}
