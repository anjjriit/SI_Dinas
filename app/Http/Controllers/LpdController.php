<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Rpd;
use App\Pengeluaran;
use App\Pegawai;
use App\Lpd;
use App\ActionHistoryLpd;
use App\TipePengeluaran;
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

    public function create(Rpd $rpd)
    {
        if (is_null($rpd->lpd)) {
            $input = [
                'nik' => Auth::user()->nik,
                'id_rpd' => $rpd->id,
                'tanggal_laporan' => date('Y-m-d'),
                'total_pengeluaran' => 0,
                'reimburse' => false,
                'status' => 'DRAFT'
            ];

            $lpd = Lpd::create($input);
        }

        return redirect('/lpd/' . $rpd->lpd->id . '/edit');
    }

    public function edit(Lpd $lpd)
    {
        $user = Auth::user();

        if ($user->nik != $lpd->nik) {
            return redirect('/lpd')->with('error', 'Anda tidak dapat melakukan edit terhadap LPD tersebut.');
        }

        $list_tipe = TipePengeluaran::orderBy('nama_kategori', 'asc')->lists('nama_kategori', 'id');

        return view('lpd.edit', compact('lpd', 'list_tipe'));
    }

    public function updateAction(Request $request, Lpd $lpd)
    {
        $user = Auth::user();

        if ($user->nik != $lpd->nik) {
            return redirect('/lpd')->with('error', 'Anda tidak dapat melakukan edit terhadap LPD tersebut.');
        }

        if ($request->input('action') == 'submit') {
            $this->updateSubmit($request, $id);

            return redirect('/lpd/submitted')->with('success', 'LPD berhasil di submit.');
        } elseif ($request->input('action') == 'draft') {
            $this->updateDraft($request, $id);

            return redirect('/lpd/draft')->with('success', 'LPD berhasil di simpan sebagai draft.');
        }
    }

    public function updateDraft(Request $request, Lpd $lpd)
    {
        $user = Auth::user();

        $lpd->tanggal_laporan = date('Y-m-d');
        $lpd->total_pengeluaran = $lpd->pengeluaran->sum('biaya');

        if ($lpd->total_pengeluaran > $lpd->rpd->akomodasi_awal) {
            $lpd->reimburse = true;
        } else {
            $lpd->reimburse = false;
        }

        $lpd->status = 'DRAFT';
        $lpd->save();

        $action = [
            'id_lpd' => $lpd->id,
            'nik' => $user->nik,
            'action' => 'DRAFT',
            'comment' => $request->input('comment')
        ];

        ActionHistoryLpd::create($action);
    }

    public function updateSubmit(Request $request, Lpd $lpd)
    {
        $user = Auth::user();

        $lpd->tanggal_laporan = date('Y-m-d');
        $lpd->total_pengeluaran = $lpd->pengeluaran->sum('biaya');

        if ($lpd->total_pengeluaran > $lpd->rpd->akomodasi_awal) {
            $lpd->reimburse = true;
        } else {
            $lpd->reimburse = false;
        }

        $lpd->kode = $this->generateCode();
        $lpd->status = 'SUBMIT';
        $lpd->save();

        $action = [
            'id_lpd' => $lpd->id,
            'nik' => $user->nik,
            'action' => 'SUBMIT',
            'comment' => $request->input('comment')
        ];

        ActionHistoryLpd::create($action);
    }

    public function addPengeluaran(Request $request, Lpd $lpd)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'id_tipe' => 'required',
            'keterangan' => 'required',
            'struk' => 'required',
            'biaya' => 'required|numeric',
            'personel' => 'required'
        ]);

        $input = $request->only(
            'tanggal',
            'id_tipe',
            'keterangan',
            'struk',
            'biaya'
        );

        $input['id_lpd'] = $lpd->id;

        $pengeluaran = Pengeluaran::create($input);

        foreach ($request->input('personel') as $personel) {
            $pengeluaran->personel()->attach($personel);
        }

        return redirect('/lpd/' . $lpd->id . '/edit')->with('success', 'Pengeluaran telah ditambahkan.');
    }

    public function editPengeluaran(Lpd $lpd, Pengeluaran $pengeluaran)
    {
        $list_tipe = TipePengeluaran::orderBy('nama_kategori', 'asc')->lists('nama_kategori', 'id');

        return view('lpd.edit_pengeluaran', compact('lpd', 'pengeluaran', 'list_tipe'));
    }

    public function updatePengeluaran(Request $request, Lpd $lpd, Pengeluaran $pengeluaran)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'id_tipe' => 'required',
            'keterangan' => 'required',
            'struk' => 'required',
            'biaya' => 'required|numeric',
            'personel' => 'required'
        ]);

        $input = $request->only(
            'tanggal',
            'id_tipe',
            'keterangan',
            'struk',
            'biaya'
        );

        $pengeluaran->fill($input)->save();

        $pengeluaran->personel()->detach();

        foreach ($request->input('personel') as $personel) {
            $pengeluaran->personel()->attach($personel);
        }

        return redirect('/lpd/' . $pengeluaran->id_lpd . '/edit')->with('success', 'Pengeluaran berhasil diedit');
    }

    public function deletePengeluaran(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect('/lpd/' . $pengeluaran->id_lpd . '/edit')->with('success', 'Pengeluaran berhasil dihapus');

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

    public function generateCode()
    {
        $last = Lpd::select('kode')->orderBy('kode', 'desc')->first();

        if (empty($last['kode'])) {
            return "LPD0001";
        } else {
            $no = str_replace('LPD', '', $last['kode']);
            $no = (int) $no + 1;

            $new = 'LPD' . str_pad($no, 4, '0', STR_PAD_LEFT);

            return $new;
        }
    }
}
