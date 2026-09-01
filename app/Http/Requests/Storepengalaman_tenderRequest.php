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
            'pekerjaan' => 'required|string',
            'lokasi' => 'required|string',
            'instansi' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric',
            'no_kontrak' => 'required|string',
            'nilai_kontrak' => 'required|numeric|min:0',
            'tgl_kontrak' => 'required|date',
            'presentasi' => 'required|integer|min:1|max:100',
            'tgl_selesai_kontrak' => 'required|date|after_or_equal:tgl_kontrak',
            'tgl_serah_terima' => 'required|date',
            'keterangan' => 'required|string',
            'file1' => 'nullable|file|mimes:jpg,jpeg,png,xls,xlsx,pdf,doc,docx,zip,rar,7z|max:10240',
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
            'pekerjaan.required' => 'Nama kontrak/pekerjaan wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'instansi.required' => 'Instansi pemberi tugas wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'Nomor telepon wajib diisi.',
            'no_hp.numeric' => 'Nomor telepon harus berupa angka.',
            'no_kontrak.required' => 'Nomor kontrak wajib diisi.',
            'nilai_kontrak.required' => 'Nilai kontrak wajib diisi.',
            'nilai_kontrak.numeric' => 'Nilai kontrak harus berupa angka.',
            'tgl_kontrak.required' => 'Tanggal kontrak wajib diisi.',
            'presentasi.required' => 'Persentase pelaksanaan wajib diisi.',
            'presentasi.min' => 'Persentase pelaksanaan minimal 1%.',
            'presentasi.max' => 'Persentase pelaksanaan maksimal 100%.',
            'tgl_selesai_kontrak.required' => 'Tanggal selesai kontrak wajib diisi.',
            'tgl_selesai_kontrak.after_or_equal' => 'Tanggal selesai kontrak tidak boleh sebelum tanggal kontrak.',
            'tgl_serah_terima.required' => 'Tanggal serah terima wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'file1.mimes' => 'Format file harus jpg, jpeg, png, xls, xlsx, pdf, doc, docx, zip, rar, atau 7z.',
            'file1.max' => 'Ukuran file maksimal 10 MB.',
            'nama_file.required' => 'Nama file wajib diisi.',
        ];
    }
}
