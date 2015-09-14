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
use App\SaranaTransportasi;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;

class RpdController extends Controller
{
    public function create()
    {
        $list_pegawai = Pegawai::orderBy('nama_lengkap', 'asc')->lists('nama_lengkap', 'nik');
        $list_kota = Kota::orderBy('nama_kota', 'asc')->lists('nama_kota', 'kode');
        if (old('id_peserta')) {
            $list_project = Project::orderBy('nama_project')->select('nama_project', 'nama_lembaga', 'kode')->get();
            $list_prospek = Prospek::orderBy('nama_prospek')->select('nama_prospek', 'nama_lembaga', 'kode')->get();
            $list_pelatihan = Pelatihan::orderBy('nama_pelatihan')->select('nama_pelatihan', 'nama_lembaga', 'kode')->get();

            return view('rpd.create', compact('list_pegawai', 'list_kota', 'list_project', 'list_prospek', 'list_pelatihan'));
        } else {
            return view('rpd.create', compact('list_pegawai', 'list_kota'));
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
            'kode_kota_asal' => 'required|exists:kota,kode',
            'kode_kota_tujuan' => 'required|exists:kota,kode',
            'sarana_penginapan' => 'required',
            'sarana_transportasi' => 'required',
            'id_peserta' => 'required',
            'tujuan_kegiatan' => 'required',
            'kode_kegiatan' => 'required',
            'kegiatan' => 'required'
        ]);

        $inputRpd = $request->only(
            'kategori',
            'jenis_perjalanan',
            'tanggal_mulai',
            'tanggal_selesai',
            'kode_kota_asal',
            'kode_kota_tujuan',
            'sarana_penginapan',
            'keterangan'
        );

        $inputRpd['kode'] = $this->generateCode();
        $inputRpd['nik'] = auth()->user()->nik;
        $inputRpd['status'] = 'SUBMIT';

        $rpd = Rpd::create($inputRpd);

        $saranaTransportasi = $request->input('sarana_transportasi');

        foreach ($saranaTransportasi as $transportasi) {
            $inputTransportasi['nama_transportasi'] = $transportasi;
            $inputTransportasi['id_rpd'] = $rpd->id;

            SaranaTransportasi::create($inputTransportasi);
        }

        $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan');

        for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
            $nik = $kegiatanPeserta['id_peserta'][$i];
            $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
            $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
            $kegiatan = $kegiatanPeserta['kegiatan'][$i];

            $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan]);
        }

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => auth()->user()->nik,
            'action' => 'SUBMIT',
            'comment' => null
        ];

        ActionHistoryRpd::create($action);
    }

    public function saveAsDraft(Request $request)
    {
        $inputRpd = $request->only(
            'kategori',
            'jenis_perjalanan',
            'tanggal_mulai',
            'tanggal_selesai',
            'kode_kota_asal',
            'kode_kota_tujuan',
            'sarana_penginapan',
            'keterangan'
        );

        $inputRpd['nik'] = auth()->user()->nik;
        $inputRpd['status'] = 'DRAFT';

        $rpd = Rpd::create($inputRpd);

        if ($request->has('sarana_transportasi')) {
            $saranaTransportasi = $request->input('sarana_transportasi');

            foreach ($saranaTransportasi as $transportasi) {
                $inputTransportasi['nama_transportasi'] = $transportasi;
                $inputTransportasi['id_rpd'] = $rpd->id;

                SaranaTransportasi::create($inputTransportasi);
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
            'comment' => null
        ];

        ActionHistoryRpd::create($action);
    }

    public function draft()
    {
        //diganti supaya hanya menampilkan rpd yang user buat saja
        $user = Auth::user();
        $userId = $user->nik;
        $draftRpds = Rpd::where('status','=','DRAFT')
                        ->where('nik','=',$userId)
                        ->paginate(15);

        return view('rpd.draft', compact('draftRpds'));
    }

    public function submitted()
    {
        $user = Auth::user();
        $userId = $user->nik;
        $submittedRpds = Rpd::where('status','=','SUBMIT')
                        ->where('nik','=',$userId)
                        ->paginate(15);

        return view('rpd.submitted', compact('submittedRpds'));
    }

    public function editRpd($id)
    {
        $rpd = Rpd::with('peserta', 'kegiatan')->findOrFail($id);

        $list_pegawai = Pegawai::orderBy('nama_lengkap', 'asc')->lists('nama_lengkap', 'nik');
        $list_kota = Kota::orderBy('nama_kota', 'asc')->lists('nama_kota', 'kode');
        $list_project = Project::orderBy('nama_project')->select('nama_project', 'nama_lembaga', 'kode')->get();
        $list_prospek = Prospek::orderBy('nama_prospek')->select('nama_prospek', 'nama_lembaga', 'kode')->get();
        $list_pelatihan = Pelatihan::orderBy('nama_pelatihan')->select('nama_pelatihan', 'nama_lembaga', 'kode')->get();

        return view(
            'rpd.edit',
            compact(
                'rpd',
                'list_pegawai',
                'list_kota',
                'list_project',
                'list_prospek',
                'list_pelatihan'
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
            'sarana_penginapan',
            'keterangan'
        );

        $inputRpd['kode'] = $this->generateCode();
        $inputRpd['nik'] = auth()->user()->nik;
        $inputRpd['status'] = 'DRAFT';

        $rpd = Rpd::findOrFail($id);

        $rpd->fill($inputRpd)->save();

        $rpd->saranaTransportasi()->delete();

        if ($request->has('sarana_transportasi')) {
            $saranaTransportasi = $request->input('sarana_transportasi');

            foreach ($saranaTransportasi as $transportasi) {
                $inputTransportasi['nama_transportasi'] = $transportasi;
                $inputTransportasi['id_rpd'] = $rpd->id;

                SaranaTransportasi::create($inputTransportasi);
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
            'comment' => null
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
            'kode_kota_asal' => 'required|exists:kota,kode',
            'kode_kota_tujuan' => 'required|exists:kota,kode',
            'sarana_penginapan' => 'required',
            'sarana_transportasi' => 'required',
            'id_peserta' => 'required',
            'tujuan_kegiatan' => 'required',
            'kode_kegiatan' => 'required',
            'kegiatan' => 'required'
        ]);

        $inputRpd = $request->only(
            'kategori',
            'jenis_perjalanan',
            'tanggal_mulai',
            'tanggal_selesai',
            'kode_kota_asal',
            'kode_kota_tujuan',
            'sarana_penginapan',
            'keterangan'
        );

        $inputRpd['kode'] = $this->generateCode();
        $inputRpd['nik'] = auth()->user()->nik;
        $inputRpd['status'] = 'SUBMIT';

        $rpd = Rpd::findOrFail($id);

        $rpd->fill($inputRpd)->save();

        $saranaTransportasi = $request->input('sarana_transportasi');

        SaranaTransportasi::where('id_rpd', $rpd->id)->delete();

        foreach ($saranaTransportasi as $transportasi) {
            $inputTransportasi['nama_transportasi'] = $transportasi;
            $inputTransportasi['id_rpd'] = $rpd->id;

            SaranaTransportasi::create($inputTransportasi);
        }

        $kegiatanPeserta = $request->only('id_peserta', 'tujuan_kegiatan', 'kode_kegiatan', 'kegiatan');

        for ($i = 0;$i < count($kegiatanPeserta['id_peserta']);$i++) {
            $nik = $kegiatanPeserta['id_peserta'][$i];
            $jenis_kegiatan = $kegiatanPeserta['tujuan_kegiatan'][$i];
            $kode_kegiatan = $kegiatanPeserta['kode_kegiatan'][$i];
            $kegiatan = $kegiatanPeserta['kegiatan'][$i];

            $rpd->peserta()->detach($nik);
            $rpd->peserta()->attach($nik, ['jenis_kegiatan' => $jenis_kegiatan, 'kode_kegiatan' => $kode_kegiatan, 'kegiatan' => $kegiatan]);
        }

        $action = [
            'id_rpd' => $rpd->id,
            'nik' => auth()->user()->nik,
            'action' => 'SUBMIT',
            'comment' => null
        ];

        ActionHistoryRpd::create($action);
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

}
