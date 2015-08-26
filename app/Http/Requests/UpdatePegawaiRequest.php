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
            'nik'          => 'required|unique:pegawai,nik,'.$this->route('pegawai')->nik.',nik',
            'nama_lengkap' => 'required',
            'email'        => 'required|unique:pegawai,email,'.$this->route('pegawai')->nik.',nik',
            'role'         => 'required|in:employee,finance,administation,super_admin',
            'active'       => 'required|in:0,1',
        ];
    }
}
