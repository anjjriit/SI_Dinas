<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Rpd;
use App\Prospek;
use App\Project;
use App\Pelatihan;

class PagesController extends Controller
{
    public function dashboard() {

        $prospeks = Prospek::all();
        $projects = Project::all();
        $pelatihans = Pelatihan::all();
        $rpds = Rpd::all();
        $users = Pegawai::all();

        return view('dashboard', compact('prospeks', 'projects', 'pelatihans', 'rpds', 'users'));
    }
}
