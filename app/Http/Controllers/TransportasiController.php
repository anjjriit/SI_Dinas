<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transportasi;
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
        return view('transportasi.cost.create')
    }

    public function storeTransportation(Request $request, Transportasi $transportasi)
    {

    }

    public function storeCost()
    {

    }

    public function show(Transportasi $transportasi)
    {
        return view('transportasi.show');
    }

    public function editTransportation(Transportasi $transportasi)
    {
        return view('transportasi.edit');
    }

    public function editCost(Transportasi $transportasi)
    {
        return view('transportasi.cost.edit');
    }

    public function update(Request $request, Transportasi $transportasi)
    {

    }

    public function deleteTransportation(Transportasi $transportasi)
    {
        $transportasi->delete();


    }

    public function deleteCost(Transportasi $transportasi)
    {

    }
}
