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
        $rules = [
            'nama_pt' => 'required',
            // 'NPWP' => 'required',
            'no_hp' => 'required',
            // 'no_tlp' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
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
            // 'nama_npwp' => 'required',
            'kswp_npwp' => 'required',
            'kswp_nama' => 'required',

        ];

        // Saat create: berkas wajib tender harus diupload & valid.
        // Saat update: berkas opsional (boleh tidak diubah) — jika ada harus valid.
        // Catatan: required file ditangani controller (pesan 'msg') agar kompatibel
        // dengan alur lama; di sini hanya validasi format & ukuran.
        $tenderId = $this->input('id');
        if ($tenderId) {
            $tender = \App\Models\tender::with('tender_file')->find($tenderId);
            if ($tender) {
                $mode = $this->isMethod('put') ? 'nullable' : 'nullable';
                foreach ($tender->tender_file as $tf) {
                    $rules['file_' . $tf->id] = $mode.'|file|mimes:jpg,jpeg,png,pdf,zip,rar,7z|max:10240';
                }
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
            'nama_pt.required' => 'Nama perusahaan wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'file_*.required' => 'File wajib tidak boleh kosong.',
            'file_*.mimes' => 'Format file harus jpg, jpeg, png, pdf, zip, rar, atau 7z.',
            'file_*.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
