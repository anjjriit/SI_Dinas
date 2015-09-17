<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Rpd;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $lpdLogs = Lpd::where('status', '!=', 'DRAFT')
                   ->where('nik', '=', $userId)
                   ->paginate(10);

        return view('lpd.log', compact('lpdLogs'));
    }

}
