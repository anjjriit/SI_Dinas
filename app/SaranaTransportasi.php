<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaranaTransportasi extends Model
{
    protected $table = 'sarana_transportasi';
    protected $fillable = ['id_rpd', 'nama_transportasi'];

}
