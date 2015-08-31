<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pegawai;
use App\Http\Requests;
use App\Http\Requests\CreatePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data_pegawai = Pegawai::orderBy('nik', 'asc')->paginate(15);

        return view('pegawai.index', compact('data_pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreatePegawaiRequest  $request
     * @return Response
     */
    public function store(CreatePegawaiRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        Pegawai::create($input);

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Pegawai $pegawai
     * @return Response
     */
    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Pegawai $pegawai
     * @return Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdatePegawaiRequest
     * @param  App\Pegawai $pegawai
     * @return Response
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        if($request->has('password')) {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        } else {
            $input = $request->except('password');
        }

        $pegawai->fill($input)->save();

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Pegawai $pegawai
     * @return Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect('/user');
    }

    /**
     * Show the form for editing the password.
     *
     * @return Response
     */
    public function editPassword()
    {
        return view('user.changepassword');
    }

    /**
     * Update the specified resource password.
     *
     * @param  Request $request
     * @return Response
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);

        $pegawai = Auth::user();

        $pegawai->password = bcrypt($request->input('password'));
        $pegawai->fill($new_password)->save();

        return redirect('/user/password')->with('success', '<i class="fa fa-fw fa-check"></i> Password berhasil diubah.');
    }
}
