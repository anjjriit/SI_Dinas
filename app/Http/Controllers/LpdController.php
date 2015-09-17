<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Rpd;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->nik;
        $approvedRpds = Rpd::where('status','=','APPROVED')
                        ->where('nik','=', $userId)
                        ->paginate(15);

        return view('lpd.index', compact('approvedRpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
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
