<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penginapan extends Model
{
    use SoftDeletes;

    protected $table = 'penginapan';
    protected $fillable = ['nama_penginapan', 'biaya'];

    protected $dates = ['deleted_at'];
}
