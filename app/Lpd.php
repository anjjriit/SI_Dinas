<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Lpd extends Model
{
    protected $table = 'lpd';

    protected $fillable = [
        'kode',
        'nik',
        'id_rpd',
        'tanggal_laporan',
        'total_pengeluaran',
        'reimburse',
        'status'
    ];

    public function scopeLog($query)
    {
        return $query->where('status', '!=', 'DRAFT');
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', '=', 'SUBMIT');
    }

    public function scopeProcessed($query)
    {
        if (Auth::user()->role == 'finance') {
            return $query->where('status', 'PROCESS PAYMENT')
                         ->orWhere('status', 'TAKE PAYMENT')
                         ->orWhere('status', 'PAYMENT RECEIVED')
                         ->orWhere('status', 'PAID');

        } elseif (Auth::user()->role == 'administration') {

            return $query->where('status', 'TAKE PAYMENT')
                         ->orWhere('status', 'PROCESS PAYMENT');
        }
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'DRAFT');
    }

    public function scopeMine($query)
    {
        return $query->where('nik', '=', auth()->user()->nik);
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'nik')->withTrashed();
    }

    public function rpd()
    {
        return $this->belongsTo('App\Rpd', 'id_rpd', 'id');
    }

    public function pengeluaran()
    {
        return $this->hasMany('App\Pengeluaran', 'id_lpd');
    }

    public function actionHistory()
    {
        return $this->hasMany('App\ActionHistoryLpd', 'id_lpd');
    }

}
