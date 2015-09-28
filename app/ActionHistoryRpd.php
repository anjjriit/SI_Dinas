<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionHistoryRpd extends Model
{
    protected $table = 'action_history_pengajuan';
    protected $fillable = ['id_rpd', 'nik', 'action', 'comment'];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nik')->withTrashed();
    }
}
