<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatetenaga_ahliRequest extends FormRequest
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
            'nama' => 'required|string',
            'tgl_lahir' => 'required|date',
            'jk' => 'required|in:Laki - Laki,Perempuan',
            'alamat' => 'required|string',
            'negara' => 'required|string',
            'jabatan' => 'required|string',
            'pengalaman' => 'required|string',
            'email' => 'required|email',
            'keterangan' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,xls,xlsx,pdf,doc,docx,zip,rar,7z|max:10240',
            'nama_file' => 'required|string',
        ];
    }

    /**
     * Pesan error ramah pengguna.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama.required' => 'Nama tenaga ahli wajib diisi.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'jk.in' => 'Jenis kelamin harus Laki - Laki atau Perempuan.',
            'alamat.required' => 'Alamat wajib diisi.',
            'negara.required' => 'Negara asal wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'pengalaman.required' => 'Pengalaman kerja wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'file.mimes' => 'Format file harus jpg, jpeg, png, xls, xlsx, pdf, doc, docx, zip, rar, atau 7z.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
            'nama_file.required' => 'Nama sertifikat wajib diisi.',
        ];
    }
}
