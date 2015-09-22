<?php

namespace App\Http\Controllers;

use App\TipePengeluaran;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TipePengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'nama_kategori';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
            $data_tipepengeluaran = TipePengeluaran::orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
        } else {
            $data_tipepengeluaran = TipePengeluaran::orderBy($orderBy, $order)->paginate(15);
        }

        return view('tipepengeluaran.index', compact('data_tipepengeluaran', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipepengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TipePengeluaran::create($request->all());

        return redirect('/tipepengeluaran')->with('success', 'Sukses menambah tipe ' . $request->all()['nama_kategori'] . '.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipePengeluaran $tipepengeluaran)
    {
        return view('tipepengeluaran.edit', compact('tipepengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipePengeluaran $tipepengeluaran)
    {

        $input = $request->all();

        $tipepengeluaran->fill($input)->save();

        return redirect('/tipepengeluaran')->with('success', 'Sukses memperbarui tipe ' . $input['nama_kategori'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipePengeluaran $tipepengeluaran)
    {
        $tipepengeluaran->delete();

        return redirect('/tipepengeluaran')->with('success', 'Sukses menghapus tipe ' . $tipepengeluaran->nama_kategori . '.');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function search(Request $request) {
        return view('tipepengeluaran.search');
    }
}
