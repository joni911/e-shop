<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreperalatanRequest extends FormRequest
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
            'jumlah' => 'required',
            'merk' => 'required',
            'tahun' => 'required',
            'kondisi' => 'required',
            'lokasi' => 'required',
            'kepemilikan' => 'required',
            'bukti' => 'required',
        ];
    }
}
