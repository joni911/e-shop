<?php

namespace App\Services;

use App\Models\administrasi_detail;
use App\Models\peserta;

/**
 * Sumber tunggal daftar langkah wizard kelengkapan peserta (7 langkah):
 * Data Perusahaan → Pengalaman → Tenaga Ahli → Peralatan → Pekerjaan Berjalan →
 * Managemen → Administrasi.
 *
 * Dipakai oleh hub "Tender Saya" (tanpa activeKey → mode ringkasan global) dan oleh
 * setiap halaman langkah (dengan activeKey → langkah yang sedang dibuka ditandai
 * `.active`, tetap berupa tautan / bebas lompat).
 *
 * @see docs/PRD_peserta_wizard_header_7langkah.md
 */
class PesertaWizardService
{
    /**
     * Bangun daftar langkah untuk satu profil peserta.
     *
     * @param  \App\Models\peserta  $profil
     * @param  string|null  $activeKey  key langkah yang sedang dibuka (null = mode hub)
     * @return \Illuminate\Support\Collection  tiap item: [key,label,url,done(mixed),active(bool)]
     */
    public static function steps(peserta $profil, ?string $activeKey = null)
    {
        // Step 7 (Administrasi) bersifat per-tender → pakai tender aktif sesi, fallback ke profil.
        $tenderId = TenderContext::tenderId($profil->tender_id ?? null) ?? $profil->tender_id;
        $admDone = $tenderId
            ? administrasi_detail::where('peserta_id', $profil->id)->where('tender_id', $tenderId)->exists()
            : false;

        $raw = [
            [
                'key'   => 'perusahaan',
                'label' => 'Data Perusahaan',
                'url'   => route('peserta.edit', [$profil->id]),
                'done'  => true,
            ],
            [
                'key'   => 'pengalaman',
                'label' => 'Pengalaman',
                'url'   => route('pengalaman.show', [$profil->id]),
                'done'  => (int) $profil->pengalaman()->count() > 0,
            ],
            [
                'key'   => 'tenaga',
                'label' => 'Tenaga Ahli',
                'url'   => route('tenagaahli.show', [$profil->id]),
                'done'  => (int) $profil->tenaga_ahli()->count() > 0,
            ],
            [
                'key'   => 'peralatan',
                'label' => 'Peralatan',
                'url'   => route('peralatan.show', [$profil->id]),
                'done'  => (int) $profil->peralatan()->count() > 0,
            ],
            [
                'key'   => 'pekerjaan',
                'label' => 'Pekerjaan Berjalan',
                'url'   => route('pekerjaan_berjalan.show', [$profil->id]),
                'done'  => (int) $profil->pekerjaan()->count() > 0,
            ],
            [
                'key'   => 'managemen',
                'label' => 'Managemen',
                'url'   => route('managemen.show', [$profil->id]),
                'done'  => (int) $profil->managemen()->count() > 0,
            ],
            [
                'key'   => 'administrasi',
                'label' => 'Administrasi',
                'url'   => route('administrasi_list.show', [$profil->id]),
                'done'  => $admDone,
            ],
        ];

        return collect($raw)->map(function ($s) use ($activeKey) {
            $s['active'] = $activeKey !== null && $s['key'] === $activeKey;
            return $s;
        });
    }
}
