<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelatihan extends Model
{
	use SoftDeletes;

    protected $table = 'pelatihan';
    protected $fillable = ['nama_pelatihan','nama_lembaga','tanggal_mulai','tanggal_selesai','alamat'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $primaryKey = 'kode';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
