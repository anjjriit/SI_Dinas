<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'penginapan';
    protected $fillable = ['nama_penginapan', 'biaya'];

    public $primaryKey = 'id';
}
