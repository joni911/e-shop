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
            'nama_pt' => 'required|string|max:255',
            // 'NPWP' => 'required',
            'no_hp' => 'required|numeric',
            // 'no_tlp' => 'required',
            'alamat' => 'required|string',
            'email' => 'required|email',
            // 'penawaran' => 'required',
            'izin' => 'required|string',
            'nomor_izin' => 'required|string',
            'izin_berlaku' => 'required|date',
            'instansi_pemberi' => 'required|string',
            'kualifikasi' => 'required|string',
            'klasifikasi' => 'required|string',
            'no_akta' => 'required',
            'tgl_akta' => 'required|date',
            'notaris' => 'required|string',
            'no_aktab' => 'required',
            'tgl_aktab' => 'required|date',
            'notaris_b' => 'required|string',
            // 'nama_npwp' => 'required',
            'kswp_npwp' => 'required|numeric',
            'kswp_nama' => 'required|string',

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
            'nama_pt.max' => 'Nama perusahaan maksimal 255 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'alamat.required' => 'Alamat wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid. Contoh: nama@perusahaan.com',
            'izin.required' => 'Izin perusahaan (NIB/IUJK) wajib diisi.',
            'nomor_izin.required' => 'Nomor izin wajib diisi.',
            'izin_berlaku.required' => 'Tanggal berlaku izin wajib diisi.',
            'izin_berlaku.date' => 'Format tanggal berlaku izin tidak valid.',
            'instansi_pemberi.required' => 'Instansi pemberi izin wajib diisi.',
            'kualifikasi.required' => 'Kualifikasi wajib diisi.',
            'klasifikasi.required' => 'Klasifikasi wajib diisi.',
            'no_akta.required' => 'Nomor akta pendirian wajib diisi.',
            'tgl_akta.required' => 'Tanggal akta pendirian wajib diisi.',
            'notaris.required' => 'Nama notaris wajib diisi.',
            'no_aktab.required' => 'Nomor akta terbaru wajib diisi.',
            'tgl_aktab.required' => 'Tanggal akta terbaru wajib diisi.',
            'notaris_b.required' => 'Nama notaris terbaru wajib diisi.',
            'kswp_npwp.required' => 'NPWP wajib diisi.',
            'kswp_npwp.numeric' => 'NPWP harus berupa angka.',
            'kswp_nama.required' => 'Nama wajib pajak wajib diisi.',
            'file_*.required' => 'File wajib tidak boleh kosong.',
            'file_*.mimes' => 'Format file harus jpg, jpeg, png, pdf, zip, rar, atau 7z.',
            'file_*.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
