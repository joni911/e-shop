<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class pesertaRequest extends FormRequest
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
            'nama_pt' => 'required',
            'NPWP' => 'required',
            'no_hp' => 'required',
            // 'no_tlp' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            // 'penawaran' => 'required',
            'izin' => 'required',
            'nomor_izin' => 'required',
            'izin_berlaku' => 'required',
            'instansi_pemberi' => 'required',
            'kualifikasi' => 'required',
            'klasifikasi' => 'required',
            'no_akta' => 'required',
            'tgl_akta' => 'required',
            'notaris' => 'required',
            'no_aktab' => 'required',
            'tgl_aktab' => 'required',
            'notaris_b' => 'required',
            'nama_npwp' => 'required',
            'kswp_npwp' => 'required',
            'kswp_nama' => 'required',

        ];
    }
}
