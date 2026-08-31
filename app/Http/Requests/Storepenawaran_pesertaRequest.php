<?php

namespace App\Http\Requests;

use App\Models\tender;
use Illuminate\Foundation\Http\FormRequest;

class Storepenawaran_pesertaRequest extends FormRequest
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
            'id' => 'required|exists:tenders,id',
            'penawaran' => 'required|numeric|min:0',
        ];

        // File wajib penawaran: aturan dinamis per tender_file (penawaran_file).
        $tender = tender::find($this->input('id'));
        if ($tender && $tender->penawaran) {
            foreach ($tender->penawaran->penawaran_file as $pf) {
                $rules['file_' . $pf->id] = 'required|file|mimes:pdf,jpg,jpeg,png,zip,rar,7z|max:10240';
            }
        }

        return $rules;
    }

    /**
     * Pesan error yang ramah pengguna.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'penawaran.required' => 'Nilai penawaran wajib diisi.',
            'penawaran.numeric' => 'Nilai penawaran harus berupa angka.',
            'file_*.required' => 'File wajib tidak boleh kosong.',
            'file_*.mimes' => 'Format file harus pdf, jpg, jpeg, png, zip, rar, atau 7z.',
            'file_*.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
