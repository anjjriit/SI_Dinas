<?php

namespace App\Http\Controllers;

use DB;
use App\Rpd;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function bulanan()
    {
        //return view();
    }

    public function tahunan()
    {
        //return view();
    }

    public function project(Request $request)
    {

        ($request->has('month')) ? $month = $request->input('month') : $month = date('m');
        ($request->has('year')) ? $year = $request->input('year') : $year = date('Y');

        // Cari Perjalanan Dinas pada waktu tertentu
        $rpds = Rpd::with('lpd')
                   ->whereRaw('MONTH(tanggal_mulai) = ' . $month)
                   ->whereRaw('YEAR(tanggal_mulai) = ' . $year)
                   ->where('status', 'APPROVED')
                   ->get();

        $biayaProject = [];
        // Cari project untuk semua kegiatan yang ada di perjalanan dinas
        foreach ($rpds as $rpd) {
            // Cek LPD
            if (!is_null($rpd->lpd)) {
                if ($rpd->lpd->status == 'PAID' || $rpd->lpd->status == 'PAYMENT RECEIVED') {

                    $bobotKegiatan = [];
                    // Hitung bobot tiap peserta
                    foreach ($rpd->peserta as $peserta) {
                        $bobotKegiatan[$peserta->nik] = $peserta->kegiatan->where('id_rpd', $rpd->id)->count();
                    }
                    echo '<br> <br> Bobot <br>';
                    var_dump($bobotKegiatan);
                    echo '<br>';

                    // Get data pengeluaran
                    foreach ($rpd->lpd->pengeluaran as $pengeluaran) {
                        $bobotProject = [];
                        $bobotPerPengeluaran = 0;

                        // Hitung bobot project per pengeluaran
                        foreach ($pengeluaran->personel as $personel) {
                            $projects = $personel->kegiatan()
                                                 ->where('jenis_kegiatan', 'project')
                                                 ->where('id_rpd', $rpd->id)
                                                 ->lists('kode_kegiatan');

                            foreach ($projects as $project) {
                                if (array_key_exists($project, $bobotProject)) {
                                    $bobotProject[$project] +=  1;
                                } else {
                                    $bobotProject[$project] = 1;
                                }
                            }

                            if (array_key_exists($personel->nik, $bobotKegiatan)) {
                                $bobotPerPengeluaran += $bobotKegiatan[$personel->nik];
                            }

                        }
                        // Distribusi biaya
                        if ($bobotPerPengeluaran > 0) {
                            $biayaPerKegiatan = $pengeluaran->biaya / $bobotPerPengeluaran;
                        } else {
                            $biayaPerKegiatan = 0;
                        }
                        foreach ($bobotProject as $id => $bobot) {
                            if (array_key_exists($id, $biayaProject)) {
                                $biayaProject[$id] += $bobot * $biayaPerKegiatan;
                            } else {
                                $biayaProject[$id] = $bobot * $biayaPerKegiatan;
                            }
                        }
                    }
                }
            }
        }

        dd($biayaProject);

        //return view('reports.project', compact(''));
    }

    public function prospek(Request $request)
    {
        //return view('reports.prospek', compact(''));
    }

    public function pelatihan(Request $request)
    {
        //return view('reports.pelatihan', compact(''));
    }
}
