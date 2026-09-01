<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateperalatanRequest extends FormRequest
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
            'nama' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'kapasitas' => 'required|string',
            'merk' => 'required|string',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'kondisi' => 'required|in:Baik,Rusak',
            'lokasi' => 'required|string',
            'kepemilikan' => 'required|in:Sewa,Miliki Sendiri',
            'bukti' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
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
            'nama.required' => 'Nama alat wajib diisi.',
            'jumlah.required' => 'Jumlah alat wajib diisi.',
            'jumlah.min' => 'Jumlah alat minimal 1.',
            'kapasitas.required' => 'Kapasitas alat wajib diisi.',
            'merk.required' => 'Merk alat wajib diisi.',
            'tahun.required' => 'Tahun pembelian wajib diisi.',
            'tahun.min' => 'Tahun pembelian minimal 1900.',
            'tahun.max' => 'Tahun pembelian tidak boleh melebihi tahun sekarang.',
            'kondisi.required' => 'Kondisi alat wajib dipilih.',
            'kondisi.in' => 'Kondisi harus Baik atau Rusak.',
            'lokasi.required' => 'Lokasi alat wajib diisi.',
            'kepemilikan.required' => 'Kepemilikan alat wajib dipilih.',
            'kepemilikan.in' => 'Kepemilikan harus Sewa atau Milik Sendiri.',
            'bukti.required' => 'Bukti kepemilikan wajib diisi.',
            'file.mimes' => 'Format file harus jpg, jpeg, png, atau pdf.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
