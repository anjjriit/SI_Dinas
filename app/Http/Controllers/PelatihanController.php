<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pelatihan;
use App\Http\Requests;
use App\Http\Requests\CreatePelatihanRequest;
use App\Http\Requests\UpdatePelatihanRequest;
use App\Http\Controllers\Controller;

class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'tanggal_mulai';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
            $data_pelatihan = Pelatihan::orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
        } else {
            $data_pelatihan = Pelatihan::orderBy($orderBy, $order)->paginate(15);
        }

        return view('pelatihan.index', compact('data_pelatihan', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pelatihan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreatePelatihanRequest  $request
     * @return Response
     */
    public function store(CreatePelatihanRequest $request)
    {
        $input = $request->all();

        Pelatihan::create($input);

        return redirect('/pelatihan')->with('success', 'Sukses menambah Pelatihan '. $input['nama_pelatihan'] .'.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateProspekRequest  $request
     * @return Response
     */
    public function ajaxStore(CreatePelatihanRequest $request)
    {
        $input = $request->all();

        Pelatihan::create($input);

        return redirect('/json/pelatihan');
    }


    /**
     * Display the specified resource.
     *
     * @param  App\Pelatihan $pelatihan
     * @return Response
     */
    public function show(Pelatihan $pelatihan)
    {
        return view('pelatihan.show', compact('pelatihan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Pelatihan $pelatihan
     * @return Response
     */
    public function edit(Pelatihan $pelatihan)
    {
        return view('pelatihan.edit', compact('pelatihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  UpdatePelatihanRequest  $request
     * @param  App\Pelatihan  $pelatihan
     * @return Response
     */
    public function update(UpdatePelatihanRequest $request, Pelatihan $pelatihan)
    {
        $input = $request->all();

        $pelatihan->fill($input)->save();

        return redirect('/pelatihan')->with('success', 'Sukses memperbaharui Pelatihan '. $input['nama_pelatihan'] .'.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Pelatihan $pelatihan
     * @return Response
     */
    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();

        return redirect('/pelatihan')->with('success', 'Sukses menghapus Pelatihan '. $pelatihan->nama_pelatihan .'.');
    }
}
