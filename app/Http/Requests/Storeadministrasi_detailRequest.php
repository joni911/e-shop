<?php

namespace App\Http\Requests;

use App\Models\administrasi;
use Illuminate\Foundation\Http\FormRequest;

class Storeadministrasi_detailRequest extends FormRequest
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
        $rules = [
            'default' => 'required',
            'peserta' => 'required',
        ];

        // Setiap item administrasi (name = id) wajib file PDF
        $tid = $this->input('default');
        if ($tid) {
            $admin = administrasi::where('tender_id', $tid)->get();
            foreach ($admin as $a) {
                $rules[(string) $a->id] = 'required|file|mimes:pdf|max:10240';
            }
        }

        return $rules;
    }

    /**
     * Pesan error ramah pengguna.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'default.required' => 'Data tender tidak valid.',
            'peserta.required' => 'Data peserta tidak valid.',
            '*.required' => 'Dokumen administrasi wajib diupload.',
            '*.mimes' => 'Format file administrasi harus PDF.',
            '*.max' => 'Ukuran file administrasi maksimal 10 MB.',
        ];
    }
}
