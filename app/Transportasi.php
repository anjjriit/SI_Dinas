<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportasi extends Model
{
    use SoftDeletes;

    protected $table = 'transportasi';
    protected $fillable = ['nama_transportasi'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];

    public function biaya()
    {
        return $this->hasMany('App\BiayaTransportasi', 'id_transportasi', 'id')->withTrashed();
    }
}
