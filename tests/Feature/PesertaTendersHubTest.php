<?php

namespace Tests\Feature;

use App\Models\daftar_peserta;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Hub "Tender Saya" (PesertaController@myTenders).
 * Menampilkan daftar tender yang sudah didaftarkan profil login.
 */
class PesertaTendersHubTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_peserta_tanpa_profil_diarahkan_ke_pendaftaran(): void
    {
        $user = User::first();
        $user->forceFill(['email_verified_at' => now()])->save();
        // jika seeder memberi profil otomatis, pastikan tidak dipakai — buat user baru peserta tanpa profil
        if ($user->peserta) {
            $this->markTestSkipped('Seeder menyediakan profil di peserta pertama.');
        }
        $this->actingAs($user)->get(route('peserta.tenders'))->assertRedirect(route('peserta.index'));
    }

    public function test_hub_menampilkan_tender_yang_terdaftar(): void
    {
        $user = User::where('hak_akses', 'peserta')->first();
        $user->forceFill(['email_verified_at' => now()])->save();
        $profil = $user->peserta;
        $this->assertNotNull($profil);

        // Daftarkan profil ke tender profil-nya agar muncul 1 baris.
        daftar_peserta::updateOrCreate(
            ['tender_id' => $profil->tender_id, 'peserta_id' => $profil->id],
            ['user_id' => $user->id]
        );

        $this->actingAs($user)
            ->get(route('peserta.tenders'))
            ->assertOk()
            ->assertSee('Tender yang Diikuti')
            ->assertSee('Edit Profil Perusahaan');
    }
}
