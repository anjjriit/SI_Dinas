<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Pegawai extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'pegawai';
    protected $fillable = ['nik', 'nama_lengkap', 'email', 'password', 'role', 'active', 'last_login'];

    protected $hidden = ['password'];

    public $primaryKey = 'nik';
    public $incrementing = false;
}
