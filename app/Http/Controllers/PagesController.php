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
use App\Http\Controllers\Auth\AuthController;

class PagesController extends Controller
{
    public function dashboard() {

        $prospeks = Prospek::all();
        $projects = Project::all();
        $pelatihans = Pelatihan::all();
        $rpds = Rpd::all();
        $users = Pegawai::all();
        $lpds = Lpd::all();

        return view('dashboard', compact('prospeks', 'projects', 'pelatihans', 'rpds', 'users','lpds'));
    }

    public function homepage() {
    	$user = Auth::user();
        $userId = $user->nik;
        $rpds = Rpd::mine()->paginate(10);
        //$lpds = Lpd::where('nik','=', $userId)
        //				->paginate(10);

        return view('homepage', compact('rpds'));

    }
}
