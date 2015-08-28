<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospek extends Model
{
    protected $table = 'prospek';
    protected $fillable = ['nama_prospek', 'nama_lembaga', 'alamat'];

    public $primaryKey = 'kode';
}
