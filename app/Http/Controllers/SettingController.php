<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function edit()
    {
        return view('setting');
    }

    public function update(Request $request)
    {
        return redirect('/setting')->with('success', 'Sukses memperbarui setting');
    }
}
