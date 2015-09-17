<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $inputRpd['nik'] = auth()->user()->nik;
        $inputRpd['status'] = 'SUBMIT';

        $rpd = Rpd::create($inputRpd);

        $transportasi = $request->input('id_transportasi');
        foreach ($request->input('id_transportasi') as $id_transportasi) {
            $rpd->saranaTransportasi()->attach($id_transportasi);
        }

        $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan');

        for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
            $nik = $kegiatanPeserta['id_peserta'][$i];
            $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
            $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
            $kegiatan = $kegiatanPeserta['kegiatan'][$i];

            $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan]);
        }

        $akomodasi = ['akomodasi_awal' => $this->simulateCost($rpd)];

        $rpd->fill($akomodasi)->save();

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => auth()->user()->nik,
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

        $inputRpd['nik'] = auth()->user()->nik;
        $inputRpd['status'] = 'DRAFT';

        $rpd = Rpd::create($inputRpd);

        if ($request->has('id_transportasi')) {
           $transportasi = $request->input('id_transportasi');

            foreach ($request->input('id_transportasi') as $id) {
                $rpd->saranaTransportasi()->attach($id);
            }
        }

        if ($request->has('id_peserta')) {
            $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan');

            for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
                $nik = $kegiatanPeserta['id_peserta'][$i];
                $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
                $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
                $kegiatan = $kegiatanPeserta['kegiatan'][$i];

                $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan]);
            }
        }

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => auth()->user()->nik,
            'action' => 'DRAFT',
            'comment' => $rpd->keterangan
        ];

        ActionHistoryRpd::create($action);
    }

    public function editRpd($id)
    {
        $rpd = Rpd::with('peserta', 'kegiatan')->findOrFail($id);

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

    public function updateAction(Request $request, $id)
    {
        if ($request->input('action') == 'submit') {
            $this->updateSubmit($request, $id);

            return redirect('/rpd/submitted')->with('success', 'Pengajuan RPD berhasil di submit.');
        } elseif ($request->input('action') == 'draft') {
            $this->updateDraft($request, $id);

            return redirect('/rpd/draft')->with('success', 'Pengajuan RPD berhasil di simpan sebagai draft.');
        }
    }

    public function updateDraft(Request $request, $id)
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

        $inputRpd['nik'] = auth()->user()->nik;
        $inputRpd['status'] = 'DRAFT';

        $rpd = Rpd::findOrFail($id);

        $rpd->fill($inputRpd)->save();

        $rpd->saranaTransportasi()->detach();

        if ($request->has('id_transportasi')) {
            $transportasi = $request->input('id_transportasi');

            foreach ($request->input('id_transportasi') as $id_transportasi) {
                $rpd->saranaTransportasi()->attach($id_transportasi);
            }

        }

        $rpd->kegiatan()->delete();

        if ($request->has('id_peserta')) {
            $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan');

            for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
                $nik = $kegiatanPeserta['id_peserta'][$i];
                $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
                $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
                $kegiatan = $kegiatanPeserta['kegiatan'][$i];

                $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan]);
            }
        }

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => auth()->user()->nik,
            'action' => 'DRAFT',
            'comment' => $rpd->keterangan
        ];

        ActionHistoryRpd::create($action);
    }

    public function updateSubmit(Request $request, $id)
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

        $rpd = Rpd::findOrFail($id);

        if ($rpd->status != 'SUBMIT')
        {
            $akomodasi = ['akomodasi_awal' => $this->simulateCost($rpd)];

            $rpd->fill($akomodasi)->save();

            $action = [
                'id_rpd' => $rpd->id,
                'nik' => auth()->user()->nik,
                'action' => 'SUBMIT',
                'comment' => null
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
            $inputRpd['nik'] = auth()->user()->nik;
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

        $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan');

        $rpd->kegiatan()->delete();

        for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
            $nik = $kegiatanPeserta['id_peserta'][$i];
            $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
            $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
            $kegiatan = $kegiatanPeserta['kegiatan'][$i];

            $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan]);
        }

    }

    public function log()
    {
        $user = Auth::user();
        $userId = $user->nik;
        $rpdLogs = Rpd::where('status','!=','DRAFT')
                        ->where('nik','=',$userId)
                        ->paginate(15);

        return view('rpd.log', compact('rpdLogs'));
    }

    public function recall($id)
    {
        $rpd = Rpd::findOrFail($id);
        $rpd->status = 'RECALL';
        $rpd->save();

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => auth()->user()->nik,
            'action' => 'RECALL',
            'comment' => null
        ];

        ActionHistoryRpd::create($action);

        return redirect('/rpd/submitted')->with('success', 'Sukses merecall RPD dengan kode ' . $rpd->kode . '.');
    }

    public function approval($id)
    {
        $rpd = Rpd::findOrFail($id);

        return view('rpd.approval', compact('rpd'));
    }

    public function submitApproval(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'comment' => 'required'
        ]);

        $rpd = Rpd::findOrFail($id);

        // ubah parameter input() sesuai form inputnya
        $rpd->status = $request->input('status');
        $rpd->save();

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => auth()->user()->nik,
            'action' => $rpd->status,
            'comment' => $request->input('komentar')
        ];

        ActionHistoryRpd::create($action);

        return redirect('/rpd/submitted')->with('success', 'Status telah terupdate');
    }

    public function editRpdAdministration($id)
    {
        $rpd = Rpd::findOrFail($id);

        $list_pegawai = Pegawai::orderBy('nama_lengkap', 'asc')->lists('nama_lengkap', 'nik');
        $list_kota = Kota::orderBy('nama_kota', 'asc')->lists('nama_kota', 'kode');
        $list_project = Project::orderBy('nama_project')->select('nama_project', 'nama_lembaga', 'kode')->get();
        $list_prospek = Prospek::orderBy('nama_prospek')->select('nama_prospek', 'nama_lembaga', 'kode')->get();
        $list_pelatihan = Pelatihan::orderBy('nama_pelatihan')->select('nama_pelatihan', 'nama_lembaga', 'kode')->get();
        $list_transportasi = Transportasi::orderBy('nama_transportasi', 'asc')->get()->all();
        $list_penginapan = Penginapan::orderBy('nama_penginapan')->lists('nama_penginapan', 'id');


        return view(
            'rpd.edit_administrasi',
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

    public function listApproval()
    {
        $approvalRpds = Rpd::where('status', '=', 'SUBMIT')->paginate(10);

        return view('rpd.index_administrasi', compact('approvalRpds'));
    }

    public function updateRpdAdministration(Request $request, $id)
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
            'kegiatan' => 'required',
            'akomodasi_awal' => 'required|numeric'
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
            'akomodasi_awal'
        );

        $rpd = Rpd::findOrFail($id);

        $rpd->fill($inputRpd)->save();

        $rpd->saranaTransportasi()->detach();

        $transportasi = $request->input('id_transportasi');

        foreach ($request->input('id_transportasi') as $id_transportasi) {
            $rpd->saranaTransportasi()->attach($id_transportasi);
        }

        $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan');

        $rpd->kegiatan()->delete();

        for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
            $nik = $kegiatanPeserta['id_peserta'][$i];
            $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
            $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
            $kegiatan = $kegiatanPeserta['kegiatan'][$i];

            $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan]);
        }
        return redirect('/rpd/submitted')->with('success', 'Sukses mengupdate pengajuan RPD dengan kode ' . $rpd->kode);
    }

    public function draft()
    {
        //diganti supaya hanya menampilkan rpd yang user buat saja
        $user = Auth::user();
        $userId = $user->nik;
        $draftRpds = Rpd::where('status','=','DRAFT')
                        ->where('nik','=',$userId)
                        ->paginate(10);

        return view('rpd.draft', compact('draftRpds'));
    }

    public function submitted()
    {
        if (auth()->user()->role == 'administration') {
            $submittedRpds = Rpd::where('status','=','SUBMIT')->paginate(10);
        } else {
            $submittedRpds = Rpd::where('nik', auth()->user()->nik)->where('status','=','SUBMIT')->paginate(10);
        }

        return view('rpd.submitted', compact('submittedRpds'));
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
