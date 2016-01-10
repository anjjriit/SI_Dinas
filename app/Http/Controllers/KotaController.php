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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'nama_kota';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
            $data_kota = Kota::orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
        } else {
            $data_kota = Kota::orderBy($orderBy, $order)->paginate(15);
        }

        return view('kota.index', compact('data_kota', 'request'));
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
     * @param  Request App\Http\Requests\CreateKotaRequest $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kota' => 'required'
        ]);

        $input = $request->all();

        Kota::create($input);

        return redirect('/kota')->with('success', 'Sukses menambah kota ' . $input['nama_kota'] . '.');
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

        return redirect('/kota')->with('success', 'Sukses memperbarui kota ' . $input['nama_kota'] . '.');
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

        return redirect('/kota')->with('success', 'Sukses menghapus kota ' . $kota->nama_kota . '.');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function search(Request $request) {
        return view('kota.search');
    }
}
