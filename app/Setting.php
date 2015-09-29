<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $fillable = ['key', 'value'];
    public $incrementing = false;
    public $timestamps = false;
    public $primaryKey = 'key';
}
