<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateRpdRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kategori' => 'required|in:trip,non_trip',
            'jenis_perjalanan' => 'required|in:dalam_kota,luar_kota',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'lama_hari' => 'required|numeric|min:1',
            'kode_kota_asal' => 'required|exists:kota,kode',
            'kode_kota_tujuan' => 'required|exists:kota,kode',
            'id_penginapan' => 'required',
            'id_transportasi' => 'required',
            'id_peserta' => 'required',
            'tujuan_kegiatan' => 'required',
            'kode_kegiatan' => 'required',
            'kegiatan' => 'required'
        ];
    }
}
