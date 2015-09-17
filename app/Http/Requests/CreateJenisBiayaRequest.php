<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateJenisBiayaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role == 'super_admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_jenis' => 'required',
            'biaya' => 'required'
        ];
    }
}
