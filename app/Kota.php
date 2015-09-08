<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
	use SoftDeletes;

    protected $table = 'kota';
    protected $fillable = ['nama_kota'];

    public $primaryKey = 'kode';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    // public function rpd(){

    //     return $this->hasMany('App\Rpd','kode_kota_tujuan','kode_kota_asal');
    // }
}
