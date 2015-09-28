<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipePengeluaran extends Model
{
    use SoftDeletes;

    protected $table = 'tipe_pengeluaran';
    protected $fillable = ['nama_kategori'];

    protected $dates = ['deleted_at'];
}
