<?php

namespace Database\Seeders;

use App\Models\tender;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder KHUSUS DEV / UJI MANUAL (DB pengadaan3) — skenario "1 tender, belum ada peserta".
 *
 * Aturan user:
 *  1. Hanya 1 tender (uji coba) — jadwal PENDAPTARAN & UPLOAD dimulai HARI INI,
 *     seluruh proses selesai dalam ±1 bulan (lihat TenderTestingSeeder).
 *  2. Data lengkap (master jenis/metode/status + syarat + berkas wajib +
 *     persyaratan + administrasi + penawaran) — dikerjakan MasterSeeder &
 *     TenderTestingSeeder.
 *  3. TIDAK membuat 1 pun user peserta / peserta / daftar_peserta / upload —
 *     ingin uji registrasi 1-per-1 secara manual.
 *
 * Catatan: 1 user ADMIN tetap dibuat (admin@pbj.go.id / password) karena
 * tender & modul admin butuh user_id; user peserta NOL.
 *
 * Jalankan: php artisan migrate:fresh
 *           php artisan db:seed --class=Database\Seeders\DevSingleTenderSeeder
 */
class DevSingleTenderSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Admin saja (tanpa peserta) ──────────────────────────────────
        if (!User::where('hak_akses', 'admin')->exists()) {
            $admin = User::create([
                'name' => 'Admin Panitia PBJ',
                'email' => 'admin@pbj.go.id',
                'password' => Hash::make('password'),
                'hak_akses' => 'admin',
            ]);
            $admin->forceFill(['email_verified_at' => now()])->save();
            $this->command?->info('[ok] Admin dibuat: admin@pbj.go.id / password');
        } else {
            $this->command?->info('[skip] Admin sudah ada — tidak membuat user apa pun.');
        }

        // ── 2. Master data (jenis pengadaan/kontrak, metode, status) ────────
        $this->call(MasterSeeder::class);

        // ── 3. Satu tender uji coba lengkap (idempotent; jadwal di-reset ke hari ini) ──
        $this->call(TenderTestingSeeder::class);

        // Opsi B: tender NON-default (default=0) → tampil di beranda/tender_home & bisa
        // didaftar peserta. Peserta TANPA profil diarahkan (TenderHomeController::show)
        // ke /peserta/{id} (form registrasi profil + berkas utk tender tsb).
        $t = tender::where('nama', 'Pengadaan Meubelair Kantor (Tender Uji Coba)')->first();
        if ($t && (int) $t->default !== 0) {
            $t->default = 0;
            $t->save();
            $this->command?->info('[ok] Tender uji default=0 (muncul di beranda, peserta daftar lewat detail tender /peserta/{id}).');
        }

        // ── 4. Ringkasan ─────────────────────────────────────────────────────
        $this->command?->info('────────────────────────────────────────────');
        $this->command?->info('[ringkasan] tender=' . tender::count()
            . ' | peserta=' . \App\Models\peserta::count()
            . ' | user peserta=' . User::where('hak_akses', 'peserta')->count()
            . ' | daftar_peserta=' . \App\Models\daftar_peserta::count());
        if ($t) {
            $this->command?->info('[uji] Buka /tender_home/' . $t->id . ' sebagai admin, atau login user peserta baru (register) lalu daftar & upload.');
        }
    }
}
