<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Rpd;
use App\Pegawai;
use App\Lpd;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;

class LpdController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->nik;
        $approvedRpds = Rpd::where('status','=','APPROVED')
                        ->where('nik','=', $userId)
                        ->paginate(15);

        return view('lpd.index', compact('approvedRpds'));
    }

    public function create()
    {
        //
    }

    public function log()
    {
        $user = Auth::user();
        $userId = $user->nik;
        $lpdLogs = Rpd::where('status', '!=', 'DRAFT')
                   ->where('nik', '=', $userId)
                   ->paginate(10);

        return view('lpd.log', compact('lpdLogs'));
    }

}
