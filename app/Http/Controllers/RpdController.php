<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rpd;
use Auth;
use App\Kota;
use App\Pegawai;
use App\HistoryRpd;
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

        return view('rpd.create', compact('list_pegawai', 'list_kota'));
    }

    public function createAction(Request $request)
    {
        if ($request->input('action') == 'submit') {
            $this->submit($request);

        } elseif ($request->input('action') == 'draft') {
            $this->saveAsDraft($request);

        }
    }

    public function submit(Request $request) {
        $this->validate($request, [
            'kategori' => 'required|in:trip,non_trip',
            'jenis_perjalanan' => 'required|in:dalam_kota,luar_kota',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:' . $request->input('tanggal_mulai'),
            'kode_kota_asal' => 'required|exists:kota,kode',
            'kode_kota_tujuan' => 'required|exists:kota,kode',
            'sarana_penginapan' => 'required|in:kost,guest_house,hotel',
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

        HistoryRpd::create($action);
    }

    public function saveAsDraft(Request $request)  {
        $this->validate($request, [

        ]);
    }

    public function draft()
    {
        $draftRpds = Rpd::orderBy('id', 'asc')->paginate(15);

        return view('rpd.draft', compact('draftRpds'));
    }

    public function submitted()
    {
        $user = Auth::user();
        $userId = $user->nik;
        $submittedRpds = Rpd::where('status','=','SUBMIT')
                        ->where('nik','=',$userId)
                        ->paginate(15);
        //$kota = Rpd::find(1)->kota;

        return view('rpd.submitted', compact('submittedRpds'));
    }
}
