<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Http\Requests\Request;

class UpdateProjectRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_prospek'   => 'required',
            'nama_lembaga'   => 'required',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'required|date',
            'alamat'         => 'required',
        ];
    }
}
