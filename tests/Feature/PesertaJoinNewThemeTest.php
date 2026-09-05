<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Regresi: halaman join tender /peserta/{tender} (PesertaController@show) untuk
 * user TANPA profil — form pendaftaran profil + berkas wajib — harus memakai
 * tema baru (ui-shell), bukan adminlte.
 */
class PesertaJoinNewThemeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function userTanpaProfil(): User
    {
        $user = User::create([
            'name' => 'PT Join Uji',
            'email' => 'join-' . now()->format('YmdHis') . '@pengadaan.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $user->forceFill(['email_verified_at' => now()])->save();
        $this->assertNull($user->peserta, 'User tes harus tanpa profil');
        return $user;
    }

    public function test_join_tender_form_memakai_tema_baru(): void
    {
        $user = $this->userTanpaProfil();
        $tender = \App\Models\tender::where('default', 0)->firstOrFail(); // tender non-default

        $resp = $this->actingAs($user)->get('/peserta/' . $tender->id);
        $resp->assertOk();

        $html = $resp->getContent();
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Pendaftaran Peserta Tender', $html);
        $this->assertStringContainsString('name="id"', $html); // hidden id tender utk store
        $this->assertStringNotContainsString('adminlte', $html);
        $this->assertStringNotContainsString('card card-primary', $html);

        // Master berkas wajib tender dirender sebagai input file
        $wajib = $tender->tender_file;
        if ($wajib->isNotEmpty()) {
            $this->assertStringContainsString('file_' . $wajib->first()->id, $html);
        }
    }
}
