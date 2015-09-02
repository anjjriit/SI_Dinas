<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\JenisBiayaPengeluaranStandard;
use App\Http\Requests;
use App\Http\Requests\CreateJenisBiayaPengeluaranStandardRequest;
use App\Http\Requests\UpdateJenisBiayaPengeluaranStandardRequest;
use App\Http\Controllers\Controller;

class JenisBiayaPengeluaranStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data_jenispengeluaranbiayastandard = JenisBiayaPengeluaranStandard::orderBy('nama_jenis', 'asc')->paginate(15);

        return view('jenisbiayapengeluaranstandard.index', compact('data_jenispengeluaranbiayastandard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('jenisbiayapengeluaranstandard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateJenisBiayaPengeluaranStandard $request
     * @return Response
     */
    public function store(CreateJenisBiayaPengeluaranStandardRequest $request)
    {
        $input = $request->all();

        JenisBiayaPengeluaranStandard::create($input);

        return redirect('/jenisbiayapengeluaranstandard')->with('success', 'Sukses menambah jenis biaya pengeluaran standard ' . $input['nama_jenis'] . '.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard
     * @return Response
     */
    public function show(JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard)
    {
        return view('jenisbiayapengeluaranstandard.show', compact('jenisbiayapengeluaranstandard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard
     * @return Response
     */
    public function edit(JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard)
    {
        return view('jenisbiayapengeluaranstandard.edit', compact('jenisbiayapengeluaranstandard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  App\Http\Requests\UpdateJenisBiayaPengeluaranStandard
     * @param  App\JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard
     * @return Response
     */
    public function update(UpdateJenisBiayaPengeluaranStandardRequest $request, JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard)
    {
        $input = $request->all();

        $jenisbiayapengeluaranstandard->fill($input)->save();

        return redirect('/jenisbiayapengeluaranstandard')->with('success', 'Sukses memperbarui jenis biaya pengeluaran standard ' . $input['nama_jenis'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard
     * @return Response
     */
    public function destroy(JenisBiayaPengeluaranStandard $jenisbiayapengeluaranstandard)
    {
        $jenisbiayapengeluaranstandard->delete();

        return redirect('/jenisbiayapengeluaranstandard')->with('success', 'Sukses menghapus jenis biaya pengeluaran standard ' . $jenisbiayapengeluaranstandard->nama_jenis . '.');
    }

}
