<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use SoftDeletes;

    protected $table = 'transportasi';
    protected $fillable = ['nama_transportasi'];

    protected $dates = ['deleted_at'];
}
