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
        $rpds = Rpd::mine()->where('status', 'BACK TO INITIATOR')->orWhere('status', 'SUBMIT')->orderBy('kode')->paginate(10);
        $users = Pegawai::all();
        $lpds = Lpd::mine()->where('status', 'BACK TO INITIATOR')->orWhere('status', 'SUBMIT')->orWhere('status', 'TAKE PAYMENT')->where('status', 'BACK TO INITIATOR')->orWhere('status', 'PROCESS PAYMENT')->orderBy('kode')->paginate(10);

        return view('dashboard', compact('prospeks', 'projects', 'pelatihans', 'rpds', 'users','lpds'));
    }

    public function homepage() {

        $rpds = Rpd::mine()->where('status', 'BACK TO INITIATOR')->orWhere('status', 'SUBMIT')->paginate(10);
        $lpds = Lpd::mine()->where('status', 'BACK TO INITIATOR')->orWhere('status', 'SUBMIT')->orWhere('status', 'TAKE PAYMENT')->where('status', 'BACK TO INITIATOR')->orWhere('status', 'PROCESS PAYMENT')->paginate(10);

        return view('homepage', compact('rpds','lpds'));

    }
}
