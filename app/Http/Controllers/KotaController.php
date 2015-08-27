<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kota;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data_kota = Kota::orderBy('nama_kota', 'asc')->paginate(15);

        return view('kota.index', compact('data_kota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('kota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kota' => 'required'
        ]);

        $input = $request->all();

        Kota::create($input);

        return redirect('/kota');
    }

    /**
     * Display the specified resource.
     *
     * @param  Kota $kota
     * @return Response
     */
    public function show(Kota $kota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Kota $kota
     * @return Response
     */
    public function edit(Kota $kota)
    {
        return view('kota.edit', compact('kota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Kota $kota
     * @return Response
     */
    public function update(Request $request, Kota $kota)
    {
        $this->validate($request, [
            'nama_kota' => 'required'
        ]);

        $input = $request->all();

        $kota->fill($input)->save();

        return redirect('/kota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Kota $kota
     * @return Response
     */
    public function destroy(Kota $kota)
    {
        $kota->delete();

        return redirect('/kota');
    }
}
