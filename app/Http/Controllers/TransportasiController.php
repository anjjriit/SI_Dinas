<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transportasi;
use App\BiayaTransportasi;
use App\Kota;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TransportasiController extends Controller
{
    public function createTransportation()
    {
        return view('transportasi.create');
    }

    public function createCost(Transportasi $transportasi)
    {
        $list_kota = Kota::orderBy('nama_kota')->lists('nama_kota', 'kode');

        return view('transportasi.cost.create', compact('transportasi', 'list_kota'));
    }

    public function storeTransportation(Request $request)
    {
        $this->validate($request, [
            'nama_transportasi' => 'required'
        ]);

        $input = $request->all();

        $transportasi = Transportasi::create($input);

        return redirect('/jenis-biaya')->with('success', 'Sukses menambah ' . $transportasi->nama_transportasi);
    }

    public function storeCost(Request $request, Transportasi $transportasi)
    {
        $this->validate($request, [
            'id_kota_asal' => 'required',
            'id_kota_tujuan' => 'required',
            'harga' => 'required|numeric'
        ]);

        $input = $request->all();
        $input['id_transportasi'] = $transportasi->id;

        $biayaTransportasi = BiayaTransportasi::create($input);

        return redirect('/jenis-biaya')->with('success', 'Sukses menambah biaya ' . $transportasi->nama_transportasi . ' dari ' . $biayaTransportasi->kotaAsal->nama_kota . ' ke ' . $biayaTransportasi->kotaTujuan->nama_kota);
    }

    public function show(Transportasi $transportasi)
    {
        return view('transportasi.show');
    }

    public function editTransportation(Transportasi $transportasi)
    {
        return view('transportasi.edit', compact('transportasi'));
    }

    public function editCost(Transportasi $transportasi, BiayaTransportasi $biayaTransportasi)
    {
        $list_kota = Kota::orderBy('nama_kota')->lists('nama_kota', 'kode');

        return view('transportasi.cost.edit', compact('transportasi', 'biayaTransportasi', 'list_kota'));
    }

    public function updateTransportation(Request $request, Transportasi $transportasi)
    {
        $this->validate($request, [
            'nama_transportasi' => 'required'
        ]);

        $input = $request->all();
        $transportasi->fill($input)->save();

        return redirect('/jenis-biaya')->with('success', 'Sukses mengupdate ' . $transportasi->nama_transportasi);
    }

    public function updateCost(Request $request, Transportasi $transportasi, BiayaTransportasi $biayaTransportasi)
    {
        $this->validate($request, [
            'id_kota_asal' => 'required',
            'id_kota_tujuan' => 'required',
            'harga' => 'required|numeric'
        ]);

        $input = $request->all();
        $input['id_transportasi'] = $transportasi->id;

        $biayaTransportasi->fill($input)->save();

        return redirect('/jenis-biaya')->with('success', 'Sukses mengupdate biaya ' . $transportasi->nama_transportasi . ' dari ' . $biayaTransportasi->kotaAsal->nama_kota . ' ke ' . $biayaTransportasi->kotaTujuan->nama_kota);
    }

    public function deleteTransportation(Transportasi $transportasi)
    {
        $transportasi->delete();

        return redirect('/jenis-biaya')->with('success', 'Sukses menghapus transportasi' . $transportasi->nama_transportasi);
    }

    public function deleteCost(Transportasi $transportasi)
    {
        return redirect()->with('success', 'Sukses menghapus biaya transportasi dari ');
    }
}
