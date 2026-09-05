<?php

namespace Tests\Feature;

use App\Models\administrasi_detail;
use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Regresi: halaman peserta/{tender}/file_tender/{peserta} harus menampilkan
 * berkas administrasi/teknis sesuai TENDER pada URL ($id), BUKAN peserta.tender_id
 * (tender registrasi awal) — satu peserta bisa ikut banyak tender (daftar_pesertas).
 *
 * Bug lama: /peserta/7/file_tender/6 menampilkan "Tidak ada file administrasi"
 * padahal administrasi_detail untuk (peserta 6, tender 7) ada di DB.
 */
class FilePesertaScopeTenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function pesertaUser(): array
    {
        $user = User::where('hak_akses', 'peserta')->first();
        $user->forceFill(['email_verified_at' => now()])->save();
        return [$user, $user->peserta];
    }

    private function tambahDetailAdministrasi(int $tenderId, int $pesertaId, int $userId, string $nama): administrasi_detail
    {
        // Master dokumen administrasi untuk tender tsb (administrasi_id NOT NULL)
        $master = \App\Models\administrasi::where('tender_id', $tenderId)->first();
        if (!$master) {
            $master = new \App\Models\administrasi();
            $master->user_id = $userId;
            $master->tender_id = $tenderId;
            $master->nama = 'Kelengkapan Dokumen Administrasi';
            $master->keterangan = 'PDF';
            $master->save();
        }

        $d = new administrasi_detail();
        $d->user_id = $userId;
        $d->tender_id = $tenderId;
        $d->peserta_id = $pesertaId;
        $d->administrasi_id = $master->id;
        $d->nama = $nama;
        $d->file = 'Tender/administrasi/' . $pesertaId . '/' . $tenderId . '/berkas-' . $nama . '.pdf';
        $d->save();
        return $d;
    }

    public function test_file_administrasi_tender_kedua_tetap_tampil(): void
    {
        [$user, $profil] = $this->pesertaUser();

        // Tender registrasi awal peserta vs tender lain yang juga diikuti peserta
        $t1 = (int) $profil->tender_id;
        $t2 = tender::where('id', '!=', $t1)->first();
        $this->assertNotNull($t2, 'Seeder harus menyediakan tender lain');
        $t2Id = (int) $t2->id;

        // Upload administrasi HANYA untuk tender kedua (kasus bug)
        $fileNama = 'Kelengkapan Tender Kedua';
        $this->tambahDetailAdministrasi($t2Id, (int) $profil->id, (int) $user->id, $fileNama);

        // URL kanonik: /peserta/{tender}/file_tender/{peserta}
        $url = '/peserta/' . $t2Id . '/file_tender/' . $profil->id;
        $resp = $this->actingAs($user)->get($url);
        $resp->assertOk();

        $html = $resp->getContent();
        $this->assertStringContainsString($fileNama, $html);
        $this->assertStringNotContainsString('Tidak ada file administrasi', $html);
    }

    public function test_file_administrasi_tender_registrasi_tetap_tampil(): void
    {
        [$user, $profil] = $this->pesertaUser();

        // Upload administrasi untuk tender registrasi awal peserta (jalur lama)
        $fileNama = 'Kelengkapan Registrasi';
        $this->tambahDetailAdministrasi((int) $profil->tender_id, (int) $profil->id, (int) $user->id, $fileNama);

        $url = '/peserta/' . $profil->tender_id . '/file_tender/' . $profil->id;
        $resp = $this->actingAs($user)->get($url);
        $resp->assertOk();

        $html = $resp->getContent();
        $this->assertStringContainsString($fileNama, $html);
        $this->assertStringNotContainsString('Tidak ada file administrasi', $html);
    }
}
