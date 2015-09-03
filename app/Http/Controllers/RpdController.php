<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pegawai;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RpdController extends Controller
{
    public function create()
    {
        $list_pegawai = Pegawai::orderBy('nama_lengkap', 'asc')->lists('nama_lengkap', 'nik');

        return view('rpd.create', compact('list_pegawai'));
    }
}
