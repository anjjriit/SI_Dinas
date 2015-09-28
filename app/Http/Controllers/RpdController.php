<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Auth;
use App\Rpd;
use App\Kota;
use App\Pegawai;
use App\Project;
use App\Prospek;
use App\Pelatihan;
use App\ActionHistoryRpd;
use App\Transportasi;
use App\Penginapan;
use App\JenisBiaya;
use App\Http\Requests;
use App\Http\Requests\CreateRpdRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;

class RpdController extends Controller
{
    public function create()
    {
        $list_pegawai = Pegawai::orderBy('nama_lengkap', 'asc')->lists('nama_lengkap', 'nik');
        $list_kota = Kota::orderBy('nama_kota', 'asc')->lists('nama_kota', 'kode');
        $list_transportasi = Transportasi::orderBy('nama_transportasi', 'asc')->get()->all();
        $list_penginapan = Penginapan::orderBy('nama_penginapan')->lists('nama_penginapan', 'id');

        if (old('id_peserta')) {
            $list_project = Project::orderBy('nama_project')->select('nama_project', 'nama_lembaga', 'kode')->get();
            $list_prospek = Prospek::orderBy('nama_prospek')->select('nama_prospek', 'nama_lembaga', 'kode')->get();
            $list_pelatihan = Pelatihan::orderBy('nama_pelatihan')->select('nama_pelatihan', 'nama_lembaga', 'kode')->get();

            return view('rpd.create', compact('list_pegawai', 'list_kota', 'list_transportasi', 'list_penginapan', 'list_project', 'list_prospek', 'list_pelatihan'));
        } else {
            return view('rpd.create', compact('list_pegawai', 'list_kota', 'list_transportasi', 'list_penginapan'));
        }
    }

    public function createAction(Request $request)
    {
        if ($request->input('action') == 'submit') {
            $this->submit($request);

            return redirect('/rpd/submitted')->with('success', 'Pengajuan RPD berhasil di submit.');
        } elseif ($request->input('action') == 'draft') {
            $this->saveAsDraft($request);

            return redirect('/rpd/draft')->with('success', 'Pengajuan RPD berhasil di simpan sebagai draft.');
        }
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required|in:trip,non_trip',
            'jenis_perjalanan' => 'required|in:dalam_kota,luar_kota',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'lama_hari' => 'required|numeric|min:1',
            'kode_kota_asal' => 'required|exists:kota,kode',
            'kode_kota_tujuan' => 'required|exists:kota,kode',
            'id_penginapan' => 'required',
            'id_transportasi' => 'required',
            'id_peserta' => 'required',
            'tujuan_kegiatan' => 'required',
            'kode_kegiatan' => 'required',
            'kegiatan' => 'required'
        ]);

        $inputRpd = $request->only(
            'kategori',
            'jenis_perjalanan',
            'tanggal_mulai',
            'lama_hari',
            'tanggal_selesai',
            'kode_kota_asal',
            'kode_kota_tujuan',
            'id_penginapan',
            'keterangan'
        );

        $inputRpd['kode'] = $this->generateCode();
        $inputRpd['nik'] = Auth::user()->nik;
        $inputRpd['status'] = 'SUBMIT';

        $rpd = Rpd::create($inputRpd);

        $transportasi = $request->input('id_transportasi');

        foreach ($request->input('id_transportasi') as $id_transportasi) {
            $rpd->saranaTransportasi()->attach($id_transportasi);
        }

        $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan', 'deskripsi');

        for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
            $nik = $kegiatanPeserta['id_peserta'][$i];
            $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
            $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
            $kegiatan = $kegiatanPeserta['kegiatan'][$i];
            $deskripsi = $kegiatanPeserta['deskripsi'][$i];

            $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan, 'deskripsi' => $deskripsi]);
        }

        $akomodasi = ['akomodasi_awal' => $this->simulateCost($rpd)];

        $rpd->fill($akomodasi)->save();

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => Auth::user()->nik,
            'action' => 'SUBMIT',
            'comment' => $rpd->keterangan
        ];

        ActionHistoryRpd::create($action);
    }

    public function saveAsDraft(Request $request)
    {
        $inputRpd = $request->only(
            'kategori',
            'jenis_perjalanan',
            'tanggal_mulai',
            'lama_hari',
            'tanggal_selesai',
            'kode_kota_asal',
            'kode_kota_tujuan',
            'id_penginapan',
            'keterangan'
        );

        $inputRpd['nik'] = Auth::user()->nik;
        $inputRpd['status'] = 'DRAFT';

        $rpd = Rpd::create($inputRpd);

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => Auth::user()->nik,
            'action' => 'DRAFT',
            'comment' => $rpd->keterangan
        ];

        ActionHistoryRpd::create($action);

        if ($request->has('id_transportasi')) {
           $transportasi = $request->input('id_transportasi');

            foreach ($request->input('id_transportasi') as $id) {
                $rpd->saranaTransportasi()->attach($id);
            }
        }

        if ($request->has('id_peserta')) {
            $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan','deskripsi');

            for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
                $nik = $kegiatanPeserta['id_peserta'][$i];
                $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
                $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
                $kegiatan = $kegiatanPeserta['kegiatan'][$i];
                $deskripsi = $kegiatanPeserta['deskripsi'][$i];

                $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan, 'deskripsi' => $deskripsi]);
            }
        }
    }

    public function editRpd(Rpd $rpd)
    {
        $user = Auth::user();

        if ($user->role == 'administration') {
            if ($rpd->status != 'SUBMIT' && $rpd->nik != $user->nik) {
                return redirect('/rpd/submitted')->with('error', 'Anda tidak dapat melakukan edit terhadap RPD tersebut.');
            }
        } else {
            if ($rpd->status == 'SUBMIT' || $rpd->nik != $user->nik) {
                return redirect('/rpd/submitted')->with('error', 'Anda tidak dapat melakukan edit terhadap RPD tersebut.');
            }
        }

        $list_pegawai = Pegawai::orderBy('nama_lengkap', 'asc')->lists('nama_lengkap', 'nik');
        $list_kota = Kota::orderBy('nama_kota', 'asc')->lists('nama_kota', 'kode');
        $list_project = Project::orderBy('nama_project')->select('nama_project', 'nama_lembaga', 'kode')->get();
        $list_prospek = Prospek::orderBy('nama_prospek')->select('nama_prospek', 'nama_lembaga', 'kode')->get();
        $list_pelatihan = Pelatihan::orderBy('nama_pelatihan')->select('nama_pelatihan', 'nama_lembaga', 'kode')->get();
        $list_transportasi = Transportasi::orderBy('nama_transportasi', 'asc')->get()->all();
        $list_penginapan = Penginapan::orderBy('nama_penginapan')->lists('nama_penginapan', 'id');

        return view(
            'rpd.edit',
            compact(
                'rpd',
                'list_pegawai',
                'list_kota',
                'list_project',
                'list_prospek',
                'list_pelatihan',
                'list_transportasi',
                'list_penginapan'
            )
        );
    }

    public function updateAction(Request $request, Rpd $rpd)
    {
        $user = Auth::user();

        if ($user->role == 'administration') {
            if ($rpd->status != 'SUBMIT' && $rpd->nik != $user->nik) {
                return redirect('/rpd/submitted')->with('error', 'Anda tidak dapat melakukan edit terhadap RPD tersebut.');
            }
        } else {
            if ($rpd->status == 'SUBMIT' || $rpd->nik != $user->nik) {
                return redirect('/rpd/submitted')->with('error', 'Anda tidak dapat melakukan edit terhadap RPD tersebut.');
            }
        }

        if ($request->input('action') == 'submit') {
            $this->updateSubmit($request, $rpd);

            if ($user->role == 'administration' && $rpd->status == 'SUBMIT') {
                return redirect('/rpd/submitted/all')->with('success', 'Pengajuan RPD berhasil di update.');
            } else {
                return redirect('/rpd/submitted')->with('success', 'Pengajuan RPD berhasil di submit.');
            }
        } elseif ($request->input('action') == 'draft') {
            $this->updateDraft($request, $rpd);

            return redirect('/rpd/draft')->with('success', 'Pengajuan RPD berhasil di simpan sebagai draft.');
        }
    }

    public function updateDraft(Request $request, Rpd $rpd)
    {
        $inputRpd = $request->only(
            'kategori',
            'jenis_perjalanan',
            'tanggal_mulai',
            'tanggal_selesai',
            'kode_kota_asal',
            'kode_kota_tujuan',
            'id_penginapan',
            'keterangan'
        );

        $rpd->fill($inputRpd)->save();

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => Auth::user()->nik,
            'action' => 'DRAFT',
            'comment' => $rpd->keterangan
        ];

        ActionHistoryRpd::create($action);

        $rpd->saranaTransportasi()->detach();

        if ($request->has('id_transportasi')) {
            $transportasi = $request->input('id_transportasi');

            foreach ($request->input('id_transportasi') as $id_transportasi) {
                $rpd->saranaTransportasi()->attach($id_transportasi);
            }
        }

        $rpd->kegiatan()->delete();

        if ($request->has('id_peserta')) {
            $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan', 'deskripsi');

            for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
                $nik = $kegiatanPeserta['id_peserta'][$i];
                $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
                $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
                $kegiatan = $kegiatanPeserta['kegiatan'][$i];
                $deskripsi = $kegiatanPeserta['deskripsi'][$i];

                $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan, 'deskripsi' => $deskripsi]);
            }
        }
    }

    public function updateSubmit(Request $request, Rpd $rpd)
    {
        $this->validate($request, [
            'kategori' => 'required|in:trip,non_trip',
            'jenis_perjalanan' => 'required|in:dalam_kota,luar_kota',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'lama_hari' => 'required|numeric|min:1',
            'kode_kota_asal' => 'required|exists:kota,kode',
            'kode_kota_tujuan' => 'required|exists:kota,kode',
            'id_penginapan' => 'required',
            'id_transportasi' => 'required',
            'id_peserta' => 'required',
            'tujuan_kegiatan' => 'required',
            'kode_kegiatan' => 'required',
            'kegiatan' => 'required'
        ]);

        if ($rpd->status != 'SUBMIT')
        {
            $akomodasi = ['akomodasi_awal' => $this->simulateCost($rpd)];

            $rpd->fill($akomodasi)->save();

            $action = [
                'id_rpd' => $rpd->id,
                'nik' => Auth::user()->nik,
                'action' => 'SUBMIT',
                'comment' => $request->input('keterangan')
            ];

            ActionHistoryRpd::create($action);
        }

        $inputRpd = $request->only(
            'kategori',
            'jenis_perjalanan',
            'tanggal_mulai',
            'lama_hari',
            'tanggal_selesai',
            'kode_kota_asal',
            'kode_kota_tujuan',
            'id_penginapan',
            'keterangan'
        );

        if (empty($rpd->kode)) {
            $inputRpd['kode'] = $this->generateCode();
        }

        if ($rpd->status != 'SUBMIT')
        {
            $inputRpd['status'] = 'SUBMIT';
        } else {
            $inputRpd['akomodasi_awal'] = $request->input('akomodasi_awal');
        }

        $rpd->fill($inputRpd)->save();

        $rpd->saranaTransportasi()->detach();

        $transportasi = $request->input('id_transportasi');

        foreach ($request->input('id_transportasi') as $id_transportasi) {
            $rpd->saranaTransportasi()->attach($id_transportasi);
        }

        $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan', 'deskripsi');

        $rpd->kegiatan()->delete();

        for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
            $nik = $kegiatanPeserta['id_peserta'][$i];
            $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
            $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
            $kegiatan = $kegiatanPeserta['kegiatan'][$i];
            $deskripsi = $kegiatanPeserta['deskripsi'][$i];

            $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan, 'deskripsi' => $deskripsi]);
        }
    }

    public function recall(Rpd $rpd)
    {
        $rpd->status = 'RECALL';
        $rpd->save();

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => Auth::user()->nik,
            'action' => 'RECALL',
            'comment' => null
        ];

        ActionHistoryRpd::create($action);

        return redirect('/rpd/submitted')->with('success', 'Sukses merecall RPD dengan kode ' . $rpd->kode . '.');
    }

    public function approval(Rpd $rpd)
    {
        return view('rpd.approval', compact('rpd'));
    }

    public function submitApproval(Request $request, Rpd $rpd)
    {
        $this->validate($request, [
            'status' => 'required',
            'comment' => 'required'
        ]);

        $rpd->status = $request->input('status');
        $rpd->save();

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => Auth::user()->nik,
            'action' => $rpd->status,
            'comment' => $request->input('comment')
        ];

        ActionHistoryRpd::create($action);

        return redirect('/rpd/submitted/all')->with('success', 'Status telah terupdate');
    }

    public function draft()
    {
        $draftRpds = Rpd::draft()->mine()->paginate(10);

        return view('rpd.draft', compact('draftRpds'));
    }

    public function submitted()
    {
        $submittedRpds = Rpd::submitted()->mine()->orderBy('kode', 'desc')->paginate(10);

        return view('rpd.submitted', compact('submittedRpds'));
    }

    public function submittedAll(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'kode';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
           $submittedRpds = Rpd::submitted()->orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
        } else {
            $submittedRpds = Rpd::submitted()->orderBy($orderBy, $order)->paginate(15);
        }

        return view('rpd.all_submitted', compact('submittedRpds', 'request'));
    }

    public function approved(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'kode';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
            $approvedRpds = Rpd::approved()->orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
        } else {
            $approvedRpds = Rpd::approved()->orderBy($orderBy, $order)->paginate(15);
        }

        return view('rpd.approved', compact('approvedRpds', 'request'));
    }

    public function log()
    {
        $rpdLogs = Rpd::log()->mine()->paginate(15);

        return view('rpd.log', compact('rpdLogs'));
    }

    public function toPdf(Rpd $rpd)
    {
        $pdf = PDF::loadView('rpd.pdf', ['rpd' => $rpd]);

        return $pdf->stream($rpd->kode . '.pdf');
        //return view('rpd.pdf', compact('rpd'));
    }

    public function generateCode()
    {
        $last = Rpd::select('kode')->orderBy('kode', 'desc')->first();

        if (empty($last['kode'])) {
            return "RPD0001";
        } else {
            $no = str_replace('RPD', '', $last['kode']);
            $no = (int) $no + 1;

            $new = 'RPD' . str_pad($no, 4, '0', STR_PAD_LEFT);

            return $new;
        }
    }

    public function simulateCost(Rpd $rpd)
    {
        $akomodasi_awal = 0;

        $jumlah_peserta = count($rpd->peserta->all());

        foreach ($rpd->saranaTransportasi->all() as $transportasi) {
            $biaya_transport = $transportasi->biaya()->where('id_kota_tujuan', $rpd->kode_kota_tujuan)->where('id_kota_asal', $rpd->kode_kota_asal)->first();

            if (is_null($biaya_transport)) {
                $biaya_standar = JenisBiaya::where('nama_jenis', 'like', '%' . $transportasi->nama_transportasi . '%')->first();

                if (is_null($biaya_standar)) {
                    $akomodasi_awal += 0;
                } else {
                    $akomodasi_awal += $biaya_standar->biaya * $jumlah_peserta;
                }
            } else {
                $akomodasi_awal += $biaya_transport->harga * $jumlah_peserta;
            }
        }

        $akomodasi_awal += $rpd->saranaPenginapan->biaya * $jumlah_peserta * $rpd->lama_hari;

        $jenis_biaya = JenisBiaya::get()->all();

        $biaya_standar = 0;

        $list_transportasi = Transportasi::lists('nama_transportasi', 'id')->all();

        foreach ($jenis_biaya as $biaya) {
            (!in_array($biaya->nama_jenis, $list_transportasi)) ?
                $biaya_standar += $biaya->biaya * $rpd->lama_hari * $jumlah_peserta : '';
        }

        $akomodasi_awal += $biaya_standar;

        return $akomodasi_awal;
    }
}
