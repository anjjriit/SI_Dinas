<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Kota extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'kota';
    protected $fillable = ['nama_kota'];

    public $primaryKey = 'id';
    public $incrementing = true;
}
