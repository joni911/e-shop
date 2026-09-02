<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

/**
 * Konteks "peserta × tender" yang sedang dikerjakan seorang peserta.
 *
 * Dipakai untuk menjembatani pemilihan tender di halaman wizard menuju
 * halaman-halaman kelengkapan (pengalaman, tenaga ahli, peralatan, dll)
 * tanpa harus membawa id tender di setiap URL (Q1 = session).
 *
 * Ditetapkan HANYA lewat route wizard yang memvalidasi kepemilikan; dibaca
 * oleh controller masing-masing modul; bisa di-*clear* bila berganti tender.
 */
class TenderContext
{
    public const KEY = 'peserta_ctx';

    /**
     * Simpan konteks aktif.
     *
     * @param  int  $pesertaId
     * @param  int  $tenderId
     * @return void
     */
    public static function set(int $pesertaId, int $tenderId): void
    {
        Session::put(self::KEY, ['peserta' => $pesertaId, 'tender' => $tenderId]);
    }

    /**
     * Ambil konteks yang tersimpan.
     *
     * @return array{peserta:int|null,tender:int|null}
     */
    public static function get(): array
    {
        $c = (array) Session::get(self::KEY, []);
        return [
            'peserta' => isset($c['peserta']) ? (int) $c['peserta'] : null,
            'tender'  => isset($c['tender']) ? (int) $c['tender'] : null,
        ];
    }

    /**
     * Ambil id peserta aktif (atau null).
     */
    public static function pesertaId(): ?int
    {
        return static::get()['peserta'];
    }

    /**
     * Ambil id tender aktif, dengan fallback ke milik profil bila tak ada konteks.
     */
    public static function tenderId(?int $fallback = null): ?int
    {
        $id = static::get()['tender'];
        return $id ?? $fallback;
    }

    /**
     * Cek apakah ada konteks aktif.
     */
    public static function has(): bool
    {
        $c = static::get();
        return $c['peserta'] !== null && $c['tender'] !== null;
    }

    /**
     * Hapus konteks (mis. ganti tender / keluar wizard).
     */
    public static function clear(): void
    {
        Session::forget(self::KEY);
    }
}
