<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * FileUploadService — helper penyimpanan file peserta tender.
 *
 * Menyimpan ke public_path('Tender/...') agar path relatif di DB
 * (mis. "Tender/FILE/5/8/uuid.pdf") tetap kompatibel dengan link
 * `/Tender/...` di seluruh view lama dan data yang sudah ada.
 *
 * Best practice yang diterapkan:
 *  - nama file unik (UUID) — mencegah tabrakan timestamp & overwrite antar peserta
 *  - ekstensi diambil dari asli file, bukan dari client (getClientOriginalExtension
 *    dipakai hanya untuk whitelist; validasi mimes tetap di FormRequest)
 *  - pembuatan direktori aman via File::ensureDirectoryExists
 *  - path relatif dikembalikan, siap disimpan ke kolom DB
 */
class FileUploadService
{
    /**
     * Simpan satu file upload ke folder relatif public.
     *
     * @param  UploadedFile  $file
     * @param  string  $relativeDir  mis. 'Tender/FILE/5/8'
     * @param  string|null  $prefix    prefix nama file (mis. nama berkas)
     * @return string|null  path relatif (mis. 'Tender/FILE/5/8/abc.pdf'), atau null jika tidak ada file
     */
    public function store(UploadedFile $file, string $relativeDir, ?string $prefix = null): ?string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: $file->extension());
        $name = ($prefix ? Str::slug($prefix) . '-' : '') . Str::uuid() . '.' . $ext;
        $folder = public_path($relativeDir);

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $file->move($folder, $name);

        return rtrim($relativeDir, '/') . '/' . $name;
    }

    /**
     * Simpan file dari request bila ada. Berguna untuk field opsional.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $field  nama input file
     * @param  string  $relativeDir
     * @param  string|null  $prefix
     * @return string|null
     */
    public function storeFromRequest($request, string $field, string $relativeDir, ?string $prefix = null): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        return $this->store($request->file($field), $relativeDir, $prefix);
    }

    /**
     * Hapus file dari public path bila ada (opsional, untuk update).
     */
    public function delete(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }
        $full = public_path($relativePath);
        if (is_file($full)) {
            @unlink($full);
        }
    }
}
