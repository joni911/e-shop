<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storepengalaman_tenderRequest extends FormRequest
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
            'pekerjaan' => 'required',
            'lokasi' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_kontrak' => 'required',
            'tgl_kontrak' => 'required',
            'presentasi' => 'required|integer|min:1|max:100' ,
            'tgl_selesai_kontrak' => 'required',
            'tgl_serah_terima' => 'required',
            'keterangan' => 'required'

        ];
    }
}
