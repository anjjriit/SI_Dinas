<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Penginapan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PenginapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return view('penginapan.index', compact('data_penginapan', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('penginapan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_penginapan' => 'required'
        ]);

        $input = $request->all();
        Penginapan::create($input);

        return redirect('/penginapan')->with('success', 'Sukses menambah penginapan' . $input['nama_penginapan'] . '.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Penginapan $penginapan
     * @return Response
     */
    public function show(Penginapan $penginapan)
    {
        return view('penginapan.show', compact('penginapan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Penginapan $penginapan
     * @return Response
     */
    public function edit(Penginapan $penginapan)
    {
        return view('penginapan.edit', compact('penginapan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Penginapan $penginapan
     * @return Response
     */
    public function update(Request $request, Penginapan $penginapan)
    {
        $this->validate($request, [
            'nama_penginapan' => 'required'
        ]);

        $input = $request->all();

        $penginapan->fill($input)->save();

        return redirect('/penginapan')->with('success', 'Sukses memperbarui nama penginapan' . $input['nama_penginapan'] . '.' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Penginapan $penginapan
     * @return Response
     */
    public function destroy(Penginapan $penginapan)
    {
        $penginapan->delete();

        return redirect('/penginapan')->with('success', 'Sukses menghapus nama penginapan' . $penginapan->nama_penginapan . '.');
    }
}
