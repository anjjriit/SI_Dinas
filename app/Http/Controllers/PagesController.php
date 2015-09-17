<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Rpd;
use App\Prospek;
use App\Proyek;
use App\Pelatihan;

class PagesController extends Controller
{
    public function dashboard() {

        $prospeks = Prospek::all();
        //$project = Project::orderBy('nama_project', 'asc')->get()->all();
        //$pelatihan = Pelatihan::orderBy('nama_pelatihan', 'asc')->get()->all();
       //$rpd = Rpd::orderBy('id', 'asc')->get()->all();
        //$user = Pegawai::orderBy('nik', 'asc')->get()->all();

        return view('dashboard', compact('prospeks'));
    }
}
