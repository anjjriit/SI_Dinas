<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryRpd extends Model
{
    protected $table = 'action_history_pengajuan';
    protected $fillable = ['id_rpd', 'nik', 'action', 'comment'];
}
