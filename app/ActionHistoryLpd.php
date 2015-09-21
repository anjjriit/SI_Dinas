<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionHistoryLpd extends Model
{
    protected $table = 'action_history_lpd';
    protected $fillable = ['id_lpd', 'nik', 'action', 'comment'];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nik');
    }
}
