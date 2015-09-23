<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'header';
    protected $fillable = ['alamat', 'no_telp', 'email', 'website'];
}
