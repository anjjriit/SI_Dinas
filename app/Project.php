<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    protected $fillable = ['nama_project', 'nama_lembaga', 'tanggal_mulai', 'tanggal_selesai', 'alamat'];

    public $primaryKey = 'kode';
}
