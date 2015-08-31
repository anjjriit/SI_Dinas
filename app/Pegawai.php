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


    /*
     * Disable "remember me" token generation
     */
    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        //
    }

    public function getRememberTokenName()
    {
        return null;
    }

    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();

        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }
}
