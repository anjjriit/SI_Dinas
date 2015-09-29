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
use App\Lpd;
use Auth;

class PagesController extends Controller
{
    public function dashboard() {

        $prospeks = Prospek::all();
        $projects = Project::all();
        $pelatihans = Pelatihan::all();
        $rpds = Rpd::orderBy('kode')->paginate(10);
        $users = Pegawai::all();
        $lpds = Lpd::orderBy('kode')->paginate(10);

        return view('dashboard', compact('prospeks', 'projects', 'pelatihans', 'rpds', 'users','lpds'));
    }

    public function homepage() {
    	
        $rpds = Rpd::mine()->backtoinitiator()->paginate(10);
        $lpds = Lpd::mine()->processed()->paginate(10);

        return view('homepage', compact('rpds','lpds'));

    }
}
