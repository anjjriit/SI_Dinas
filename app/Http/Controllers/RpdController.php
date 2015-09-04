<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pegawai;
use App\Kota;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RpdController extends Controller
{
    public function create()
    {
        $list_pegawai = Pegawai::orderBy('nama_lengkap', 'asc')->lists('nama_lengkap', 'nik');
        $list_kota = Kota::orderBy('nama_kota', 'asc')->lists('nama_kota', 'kode');

        return view('rpd.create', compact('list_pegawai', 'list_kota'));
    }

    public function draft()
    {
        return view('rpd.draft');
    }
}
