<?php

namespace Tests\Feature;

use App\Models\daftar_peserta;
use App\Models\peserta;
use App\Models\penawaran;
use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Regresi untuk bug yang diperbaiki pada branch update-ui-2-fix-kode:
 * 1. User TANPA profil peserta tidak boleh upload penawaran (harus redirect, bukan 500).
 * 2. User yang BELUM terdaftar (daftar_peserta) tidak boleh mengupload penawaran
 *    — guard di PenawaranFileController::show & PenawaranPesertaController::store.
 * 3. Daftar peserta DUPLIKAT ditolak.
 */
class UploadGuardFixTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    /** User peserta baru TANPA profil peserta */
    private function userTanpaProfil(): User
    {
        $u = User::create([
            'name' => 'PT Tanpa Profil',
            'email' => 'tanpa-profil@pengadaan.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    public function test_user_tanpa_profil_tidak_error_500_saat_buka_halaman_upload()
    {
        $user = $this->userTanpaProfil();

        $response = $this->actingAs($user)->get('/penawaran_file/5');

        $response->assertStatus(302); // redirect ke lengkapi profil, bukan 500
        $response->assertSessionHasErrors('msg');
    }

    public function test_user_tanpa_profil_tidak_bisa_submit_penawaran()
    {
        $user = $this->userTanpaProfil();
        $penawaran = penawaran::where('tender_id', 5)->firstOrFail();

        $payload = ['id' => 5, 'penawaran' => 1445000000];
        foreach ($penawaran->penawaran_file as $pf) {
            $payload['file_' . $pf->id] = UploadedFile::fake()->create('penawaran.pdf', 100, 'application/pdf');
        }

        $response = $this->actingAs($user)
            ->from('/penawaran_file/5')
            ->post('/penawaran_peserta', $payload);

        $response->assertRedirect('/penawaran_file/5');
        $response->assertSessionHasErrors('msg');
        $this->assertDatabaseMissing('penawaran_pesertas', ['tender_id' => 5, 'user_id' => $user->id]);
    }

    public function test_daftar_peserta_duplikat_ditolak()
    {
        $user = User::find(2); // peserta1
        $profil = peserta::find(1);
        $target = tender::where('default', 0)->where('id', '!=', 2)->firstOrFail();

        // Daftar pertama sukses
        $this->actingAs($user)->post('/daftar_peserta', [
            'id' => $profil->id,
            'tender_id' => $target->id,
        ]);

        // Daftar kedua (duplikat) harus ditolak
        $response = $this->actingAs($user)
            ->from('/tender_home/' . $target->id)
            ->post('/daftar_peserta', [
                'id' => $profil->id,
                'tender_id' => $target->id,
            ]);

        $response->assertRedirect('/tender_home/' . $target->id);
        $response->assertSessionHasErrors('msg');
        $this->assertSame(
            1,
            daftar_peserta::where('tender_id', $target->id)
                ->where('peserta_id', $profil->id)
                ->count(),
            'Peserta hanya boleh terdaftar satu kali per tender'
        );
    }

    public function test_user_tanpa_profil_tidak_bisa_mendaftar_tender()
    {
        $user = $this->userTanpaProfil();
        $target = tender::where('default', 0)->firstOrFail();

        $response = $this->actingAs($user)
            ->from('/tender_home/' . $target->id)
            ->post('/daftar_peserta', [
                'id' => 999, // id tidak valid, tapi harus ditolak sebelum apa pun
                'tender_id' => $target->id,
            ]);

        $response->assertRedirect('/tender_home/' . $target->id);
        $response->assertSessionHasErrors('msg');
        $this->assertDatabaseMissing('daftar_pesertas', ['tender_id' => $target->id, 'user_id' => $user->id]);
    }
}
