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
        $lpdLogs = Lpd::where('status', '!=', 'DRAFT')
                   ->where('nik', '=', $userId)
                   ->paginate(10);

        return view('lpd.log', compact('lpdLogs'));
    }

    public function submittedAll()
    {
        $submittedLpds = Lpd::submitted()->orderBy('kode', 'desc')->paginate(10);

        return view('lpd.all_submitted', compact('submittedLpds'));
    }

    public function processed()
    {
        $processedLpds = Lpd::processed()->orderBy('kode', 'desc')->paginate(10);

        return view('lpd.processed', compact('processedLpds'));
    }

    public function approval(Lpd $lpd)
    {
        $user = Auth::user();

        if ($lpd->status == 'SUBMIT' && $user->role == 'finance') {
            return view('lpd.approval_finance', compact('lpd'));

        } elseif (($lpd->status == 'PROCESS PAYMENT' || $lpd->status == 'TAKE PAYMENT') && $user->role == 'administration') {
            return view('lpd.approval_administration', compact('lpd'));

        }
    }

}
