<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoremanagemenRequest extends FormRequest
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
            'nama' => 'required',
            'tgl_menjabat' => 'required',
            'tgl_berakhir' => 'required',
            'ktp' => 'required',
            'alamat' => 'required',
            'npwp' => 'required',
            'status' => 'required',

        ];
    }
}
