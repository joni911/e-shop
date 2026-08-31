<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresanggahRequest extends FormRequest
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
            'keterangan' => 'required',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,zip,rar,7z|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'keterangan.required' => 'Keterangan sanggahan wajib diisi.',
            'file.required' => 'File sanggahan wajib diupload.',
            'file.mimes' => 'Format file harus pdf, jpg, jpeg, png, zip, rar, atau 7z.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
