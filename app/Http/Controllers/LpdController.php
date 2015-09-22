<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Rpd;
use App\Pegawai;
use App\Lpd;
use App\ActionHistoryLpd;
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

    public function create(Request $request)
    {
        $rpdId = $request->get('rpdId');
        $rpd = Rpd::find($rpdId);

        $lpd = new \App\Lpd();
        $lpd->nik = Auth::user()->nik;
        $lpd->id_rpd = $rpdId;
        $lpd->save();
        $lpd->kode = "LPD"+$lpd->id+''+$rpd->kode;
        $lpd->save();
       

        return view('lpd.create', compact('rpd'));
    }

    public function log()
    {
        $lpdLogs = Lpd::log()->mine()->paginate(15);

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
            return view('lpd.approval', compact('lpd'));

        }
    }

    public function submitApproval(Request $request, Lpd $lpd)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $user = Auth::user();

        if ($user->role == 'finance') {
            if ($lpd->status != 'SUBMIT') {
                return redirect('/lpd/submitted/all')->with('error', 'Anda tidak dapat melakukan approval terhadap LPD tersebut.');
            }

            $lpd->status = $request->input('status');
            $lpd->save();

            $action = [
                'id_lpd' => $lpd->id,
                'nik' => $user->nik,
                'action' => $lpd->status,
                'comment' => $request->input('comment')
            ];

            ActionHistoryLpd::create($action);
            return redirect('/lpd/submitted/all')->with('success', 'Status telah terupdate');

        } elseif ($user->role == 'administration') {
            if ($lpd->status != 'PROCESS PAYMENT' && $lpd->status != 'TAKE PAYMENT') {
                return redirect('/lpd/submitted/all')->with('error', 'Anda tidak dapat melakukan approval terhadap LPD tersebut.');
            }

            if ($lpd->reimburse) {
                $lpd->status = 'PAID';
            } else {
                $lpd->status = 'PAYMENT RECEIVED';
            }

            $lpd->save();

            $action = [
                'id_lpd' => $lpd->id,
                'nik' => $user->nik,
                'action' => $lpd->status,
                'comment' => $request->input('comment')
            ];

            ActionHistoryLpd::create($action);

            return redirect('/lpd/processed')->with('success', 'Status telah terupdate');
        }
    }

    public function approved()
    {
        $approvedLpds = Lpd::where('status', '=', 'PAID')->orWhere('status', '=', 'PAYMENT RECEIVED')->paginate(10);

        return view('lpd.approved', compact('approvedLpds'));
    }

    public function submitted()
    {
        $submittedLpds = Lpd::submitted()->mine()->orderBy('kode', 'dsc')->paginate(10);

        return view('lpd.submitted', compact('submittedLpds'));
    }

    public function recall($id)
    {
        $lpd = Rpd::findOrFail($id);

        $lpd->status = 'RECALL';
        $lpd->save();

        $action = [
            'id_rpd' => $lpd->id,
            'nik' => Auth::user()->nik,
            'action' => 'RECALL',
            'comment' => null
        ];

        ActionHistoryLpd::create($action);

        return redirect('/lpd/submitted')->with('success', 'Sukses merecall LPD dengan kode ' . $lpd->kode . '.');
    }

    public function store(Request $request){



        return redirect('lpd.item.create');
    }
}
