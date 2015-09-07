<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pegawai;
use App\Project;
use App\Prospek;
use App\Pelatihan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JsonController extends Controller
{
    public function pegawai()
    {
        $pegawai = Pegawai::all();

        return $pegawai->toJson();
    }

    public function project()
    {
        $project = Project::orderBy('nama_project', 'asc')->get();

        return $project->toJson();
    }

    public function prospek()
    {
        $prospek = Prospek::all();

        return $prospek->toJson();
    }

    public function pelatihan()
    {
        $pelatihan = Pelatihan::all();

        return $pelatihan;

    }
}
