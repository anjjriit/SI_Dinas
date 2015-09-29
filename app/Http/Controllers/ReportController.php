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
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Cari Perjalanan Dinas pada waktu tertentu
        $rpds = Rpd::with('lpd')
                   ->whereRaw('(MONTH(tanggal_mulai) = ' . $month . ' OR MONTH(tanggal_selesai) = ' . $month . ')')
                   ->whereRaw('(YEAR(tanggal_mulai) = ' . $year . ' OR YEAR(tanggal_selesai) = ' . $year . ')')
                   ->where('status', 'APPROVED')
                   ->get();
        $biayaProject = [];
        if ($rpds->count() > 0) {
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

                        // Get data pengeluaran
                        foreach ($rpd->lpd->pengeluaran()->whereRaw('MONTH(tanggal) = ' . $month)->whereRaw('YEAR(tanggal) = ' . $year)->get() as $pengeluaran) {
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

                            // Hitung biaya per project
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

                if (!isset($activities)) {
                    $activities = $rpd->kegiatan()->where('jenis_kegiatan', 'project')->get();
                } else {
                    $activities = $activities->merge($rpd->kegiatan()->where('jenis_kegiatan', 'project')->get());
                }
            }

            $activities = $activities->unique('kode_kegiatan');
        } else {
            $activities = collect([]);
        }

        return view('reports.project', compact('activities', 'biayaProject', 'request'));
    }

    public function prospek(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Cari Perjalanan Dinas pada waktu tertentu
        $rpds = Rpd::with('lpd')
                   ->whereRaw('(MONTH(tanggal_mulai) = ' . $month . ' OR MONTH(tanggal_selesai) = ' . $month . ')')
                   ->whereRaw('(YEAR(tanggal_mulai) = ' . $year . ' OR YEAR(tanggal_selesai) = ' . $year . ')')
                   ->where('status', 'APPROVED')
                   ->get();
        $biayaProspek = [];

        if ($rpds->count() > 0) {
            // Cari prospek untuk semua kegiatan yang ada di perjalanan dinas
            foreach ($rpds as $rpd) {
                // Cek LPD
                if (!is_null($rpd->lpd)) {
                    if ($rpd->lpd->status == 'PAID' || $rpd->lpd->status == 'PAYMENT RECEIVED') {

                        $bobotKegiatan = [];
                        // Hitung bobot tiap peserta
                        foreach ($rpd->peserta as $peserta) {
                            $bobotKegiatan[$peserta->nik] = $peserta->kegiatan->where('id_rpd', $rpd->id)->count();
                        }

                        // Get data pengeluaran
                        foreach ($rpd->lpd->pengeluaran()->whereRaw('MONTH(tanggal) = ' . $month)->whereRaw('YEAR(tanggal) = ' . $year)->get() as $pengeluaran) {
                            $bobotProspek = [];
                            $bobotPerPengeluaran = 0;

                            // Hitung bobot prospek per pengeluaran
                            foreach ($pengeluaran->personel as $personel) {
                                $prospects = $personel->kegiatan()
                                                     ->where('jenis_kegiatan', 'prospek')
                                                     ->where('id_rpd', $rpd->id)
                                                     ->lists('kode_kegiatan');

                                foreach ($prospects as $prospek) {
                                    if (array_key_exists($prospek, $bobotProspek)) {
                                        $bobotProspek[$prospek] +=  1;
                                    } else {
                                        $bobotProspek[$prospek] = 1;
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

                            // Hitung biaya per prospek
                            foreach ($bobotProspek as $id => $bobot) {
                                if (array_key_exists($id, $biayaProspek)) {
                                    $biayaProspek[$id] += $bobot * $biayaPerKegiatan;
                                } else {
                                    $biayaProspek[$id] = $bobot * $biayaPerKegiatan;
                                }
                            }
                        }
                    }
                }

                if (!isset($activities)) {
                    $activities = $rpd->kegiatan()->where('jenis_kegiatan', 'prospek')->get();
                } else {
                    $activities = $activities->merge($rpd->kegiatan()->where('jenis_kegiatan', 'prospek')->get());
                }
            }

            $activities = $activities->unique('kode_kegiatan');
        } else {
            $activities = collect([]);
        }

        return view('reports.prospek', compact('activities', 'biayaProspek', 'request'));
    }

    public function pelatihan(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Cari Perjalanan Dinas pada waktu tertentu
        $rpds = Rpd::with('lpd')
                   ->whereRaw('(MONTH(tanggal_mulai) = ' . $month . ' OR MONTH(tanggal_selesai) = ' . $month . ')')
                   ->whereRaw('(YEAR(tanggal_mulai) = ' . $year . ' OR YEAR(tanggal_selesai) = ' . $year . ')')
                   ->where('status', 'APPROVED')
                   ->get();
        $biayaPelatihan = [];
        if ($rpds->count() > 0) {
            // Cari pelatihan untuk semua kegiatan yang ada di perjalanan dinas
            foreach ($rpds as $rpd) {
                // Cek LPD
                if (!is_null($rpd->lpd)) {
                    if ($rpd->lpd->status == 'PAID' || $rpd->lpd->status == 'PAYMENT RECEIVED') {

                        $bobotKegiatan = [];
                        // Hitung bobot tiap peserta
                        foreach ($rpd->peserta as $peserta) {
                            $bobotKegiatan[$peserta->nik] = $peserta->kegiatan->where('id_rpd', $rpd->id)->count();
                        }

                        // Get data pengeluaran
                        foreach ($rpd->lpd->pengeluaran()->whereRaw('MONTH(tanggal) = ' . $month)->whereRaw('YEAR(tanggal) = ' . $year)->get() as $pengeluaran) {
                            $bobotPelatihan = [];
                            $bobotPerPengeluaran = 0;

                            // Hitung bobot pelatihan per pengeluaran
                            foreach ($pengeluaran->personel as $personel) {
                                $trainings = $personel->kegiatan()
                                                     ->where('jenis_kegiatan', 'pelatihan')
                                                     ->where('id_rpd', $rpd->id)
                                                     ->lists('kode_kegiatan');

                                foreach ($trainings as $pelatihan) {
                                    if (array_key_exists($pelatihan, $bobotPelatihan)) {
                                        $bobotPelatihan[$pelatihan] +=  1;
                                    } else {
                                        $bobotPelatihan[$pelatihan] = 1;
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

                            // Hitung biaya per pelatihan
                            foreach ($bobotPelatihan as $id => $bobot) {
                                if (array_key_exists($id, $biayaPelatihan)) {
                                    $biayaPelatihan[$id] += $bobot * $biayaPerKegiatan;
                                } else {
                                    $biayaPelatihan[$id] = $bobot * $biayaPerKegiatan;
                                }
                            }
                        }
                    }
                }

                if (!isset($activities)) {
                    $activities = $rpd->kegiatan()->where('jenis_kegiatan', 'pelatihan')->get();
                } else {
                    $activities = $activities->merge($rpd->kegiatan()->where('jenis_kegiatan', 'pelatihan')->get());
                }
            }

            $activities = $activities->unique('kode_kegiatan');
        } else {
            $activities = collect([]);
        }

        return view('reports.pelatihan', compact('activities', 'biayaPelatihan', 'request'));
    }
}
