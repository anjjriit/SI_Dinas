<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kota;
use App\Http\Requests;
use App\Http\Requests\CreateKotaRequest;
use App\Http\Requests\UpdateKotaRequest;
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
        $data_kota = Kota::orderBy('id', 'asc');

        return view('kota.index', compact('data_kota'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('kota.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request App\Http\Requests\CreateKotaRequest $request
     * @return Response
     */
    public function store(CreateKotaRequest $request)
    {
         $input = $request->all();

        Kota::create($input);

        return redirect('/kota');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Kota $kota
     * @return Response
     */
    public function show(Kota $kota)
    {
        return view('kota.show', compact('kota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Kota $kota
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
     * @param  App\Http\Requests\UpdateKotaRequest
     * @param  App\Kota $kota
     * @return Response
     */
    public function update(UpdateKotaRequest $request, Kota $kota)
    {
        $input = $request->all();

        $kota->fill($input)->save();

        return redirect('/kota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Kota $kota
     * @return Response
     */
    public function destroy(Kota $kota)
    {
        $kota->delete();

        return redirect('/kota');
    }
}
