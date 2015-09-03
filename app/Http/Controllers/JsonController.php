<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pegawai;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JsonController extends Controller
{
    public function pegawai()
    {
        $pegawai = Pegawai::all();

        return $pegawai->toJson();
    }
}
