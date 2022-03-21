<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tenderRequest extends FormRequest
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
            //
            'nama' => 'required',
            'jk' => 'required',
            'jp'  => 'required',
            'mp' => 'required',
            'klpd' => 'required',
            'lokasi' => 'required',
            'dana' => 'required',
            'satuan_kerja' => 'required',
            'tanggal' => 'required',
            'nilai' => 'required',
            'hps' => 'required',
            'status' => 'required',
        ];
    }
}
