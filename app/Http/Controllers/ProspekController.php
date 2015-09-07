<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Prospek;
use App\Http\Requests;
use App\Http\Requests\CreateProspekRequest;
use App\Http\Requests\UpdateProspekRequest;
use App\Http\Controllers\Controller;

class ProspekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'nama_prospek';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
            $data_prospek = Prospek::orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
        } else {
            $data_prospek = Prospek::orderBy($orderBy, $order)->paginate(15);
        }

        return view('prospek.index', compact('data_prospek', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('prospek.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateProspekRequest  $request
     * @return Response
     */
    public function store(CreateProspekRequest $request)
    {
        $input = $request->all();

        Prospek::create($input);

        return redirect('/prospek')->with('success', 'Sukses menambah prospek ' . $input['nama_prospek'] . '.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateProspekRequest  $request
     * @return Response
     */
    public function ajaxStore(CreateProspekRequest $request)
    {
        $input = $request->all();

        Prospek::create($input);

        return redirect('/json/prospek');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Prospek $prospek
     * @return Response
     */
    public function show(Prospek $prospek)
    {
        return view('prospek.show', compact('prospek'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Prospek $prospek
     * @return Response
     */
    public function edit(Prospek $prospek)
    {
        return view('prospek.edit', compact('prospek'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  App\Http\Requests\UpdateProspekRequest
     * @param  App\Prospek $prospek
     * @return Response
     */
    public function update(UpdateProspekRequest $request, Prospek $prospek)
    {
        $input = $request->all();

        $prospek->fill($input)->save();

        return redirect('/prospek')->with('success', 'Sukses memperbarui prospek ' . $input['nama_prospek'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Prospek $prospek
     * @return Response
     */
    public function destroy(Prospek $prospek)
    {
        $prospek->delete();

        return redirect('/prospek')->with('success', 'Sukses menghapus prospek ' . $prospek->nama_prospek . '.');
    }
}
