<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\JenisBiaya;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JenisBiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $orderBy = ($request->has('orderBy')) ? $request->input('orderBy') : 'nama_jenis';
        $order = ($request->has('order')) ? $request->input('order') : 'asc';

        if ($request->has('query')) {
            if ($request->input('searchBy') == 'biaya') {
                $data_jenisBiaya = JenisBiaya::orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', $request->input('query'))->paginate(15);
            } else {
                $data_jenisBiaya = JenisBiaya::orderBy($orderBy, $order)->where($request->input('searchBy'), 'like', '%' . $request->input('query') . '%')->paginate(15);
            }
        } else {
            $data_jenisBiaya = JenisBiaya::orderBy($orderBy, $order)->paginate(15);
        }

        return view('biaya.index', compact('data_jenisBiaya', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('biaya.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jenis' => 'required',
            'biaya' => 'required'
        ]);
        $input = $request->all();

        JenisBiaya::create($input);

        return redirect('/jenis-biaya')->with('success', 'Sukses menambah jenis biaya pengeluaran standar ' . $input['nama_jenis'] . '.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\JenisBiaya $jenisBiaya
     * @return Response
     */
    public function show(JenisBiaya $jenisBiaya)
    {
        return view('biaya.show', compact('jenisBiaya'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\JenisBiaya $jenisBiaya
     * @return Response
     */
    public function edit(JenisBiaya $jenisBiaya)
    {
        return view('biaya.edit', compact('jenisBiaya'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Request
     * @param  App\JenisBiaya $jenisBiaya
     * @return Response
     */
    public function update(Request $request, JenisBiaya $jenisBiaya)
    {
        $this->validate($request, [
            'nama_jenis' => 'required',
            'biaya' => 'required'
        ]);
        $input = $request->all();

        $jenisBiaya->fill($input)->save();

        return redirect('/jenis-biaya')->with('success', 'Sukses memperbarui jenis biaya pengeluaran standar ' . $input['nama_jenis'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\JenisBiaya $jenisBiaya
     * @return Response
     */
    public function destroy(JenisBiaya $jenisBiaya)
    {
        $jenisBiaya->delete();

        return redirect('/jenis-biaya')->with('success', 'Sukses menghapus jenis biaya pengeluaran standar ' . $jenisBiaya->nama_jenis . '.');
    }

}
