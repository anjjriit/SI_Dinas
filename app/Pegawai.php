<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Pegawai extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use SoftDeletes;

    protected $table = 'pegawai';
    protected $fillable = ['nik', 'nama_lengkap', 'email', 'password', 'role', 'active', 'last_login'];

    protected $hidden = ['password'];

    public $primaryKey = 'nik';
    public $incrementing = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function otherAdmin()
    {
        return ($this->role == 'super_admin') && ($this->nik != auth()->user()->nik);
    }

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
