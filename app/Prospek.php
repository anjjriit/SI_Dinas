<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prospek extends Model
{
	use SoftDeletes;

    protected $table = 'prospek';
    protected $fillable = ['nama_prospek', 'nama_lembaga', 'alamat'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $primaryKey = 'kode';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
