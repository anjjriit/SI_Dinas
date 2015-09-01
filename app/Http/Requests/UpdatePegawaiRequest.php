<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePegawaiRequest extends Request
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
            'nik'          => 'required|unique:pegawai,nik,'.$this->route('user')->nik.',nik',
            'nama_lengkap' => 'required',
            'email'        => 'required|unique:pegawai,email,'.$this->route('user')->nik.',nik',
            'role'         => 'required|in:employee,finance,administration,super_admin',
            'active'       => 'required|in:0,1',
        ];
    }
}
