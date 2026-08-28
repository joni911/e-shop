<?php

namespace Database\Seeders;

use App\Models\daftar_peserta;
use App\Models\penawaran;
use App\Models\penawaran_peserta;
use App\Models\peserta;
use App\Models\tender;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Seeder KHUSUS TEST untuk alur REGISTRASI & UPLOAD PENAWARAN (F3).
 *
 * Menyiapkan:
 *  1. User peserta FRESH (id tinggi, email unik) yang BELUM punya profil peserta
 *     -> untuk test GET /peserta/create (form registrasi) & POST /peserta (store).
 *  2. Memastikan tender uji coba (TenderTestingSeeder) tersedia + data penawaran
 *     -> untuk test GET /penawaran_file/{id} (form upload) & POST /penawaran_peserta.
 *
 *  Dapat dijalankan berulang (idempotent-ish): cek existing sebelum create.
 */
class RegistrasiUploadTestSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1) Pastikan tender uji coba (id tinggi, jadwal reset hari ini) + data penawaran.
        $this->call(TenderTestingSeeder::class);

        // 2) User peserta reg-test (belum punya profil peserta) — email unik per tanggal.
        $email = 'registrasi-test-' . now()->format('YmdHis') . '@pengadaan.test';
        $user = User::create([
            'name' => 'PT Registrasi Uji Coba',
            'email' => $email,
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $user->forceFill(['email_verified_at' => now()])->save();

        $this->command?->info("[ok] User registrasi-test dibuat: {$user->email} (id={$user->id})");
        $this->command?->info("[ok] Kredensial: email={$email} password=password (verified). Login lalu GET /peserta/create.");
        $this->command?->info("[ok] Tender uji coba di-reset ke hari ini. GET /tender_home/{id} -> detail -> daftar -> upload penawaran.");
        $this->command?->info("[ok] Untuk melihat tender uji: " . tender::where('default', 0)->latest('id')->first()?->id);
    }
}
