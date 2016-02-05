<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::lists('value', 'key')->all();
        return view('setting', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->except('_method', '_token');

        foreach ($settings as $key => $value) {
            $set = Setting::find($key);

            $set->fill(['value' => $value])->save();
        }

        return redirect('/setting')->with('success', 'Sukses memperbarui pengaturan');
    }
}
