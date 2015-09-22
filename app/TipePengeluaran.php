<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipePengeluaran extends Model
{
    protected $table = 'tipe_pengeluaran';
    protected $fillable = ['nama_kategori'];
}
