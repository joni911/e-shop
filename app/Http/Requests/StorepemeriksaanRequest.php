<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepemeriksaanRequest extends FormRequest
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

            'peserta_id' => 'required|unique:pemeriksaans',
            'pengalaman' => 'required',
            'tenaga_ahli' => 'required',
            'peralatan' => 'required',
            'pekerjaan_berjalan' => 'required',
            'managemen' => 'required'
        ];
    }
}
