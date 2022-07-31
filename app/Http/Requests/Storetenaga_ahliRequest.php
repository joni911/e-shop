<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storetenaga_ahliRequest extends FormRequest
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
            'id' => 'required',
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'negara' => 'required',
            'jabatan' => 'required',
            'pengalaman' => 'required',
            'email' => 'required',
            'keterangan' => 'required'
        ];
    }
}
