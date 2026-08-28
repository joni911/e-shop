<?php

namespace Tests\Feature;

use App\Models\peserta;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F3 — Registrasi & Upload Peserta: verifikasi form registrasi & halaman upload
 * penawaran render dengan tema orange (layout baru) + data lama dipertahankan.
 */
class RegistrasiUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    /** User peserta fresh (belum punya profil) */
    private function freshPeserta(): User
    {
        $u = User::create([
            'name' => 'PT Registrasi Baru',
            'email' => 'fresh-registrasi@pengadaan.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    private function peserta(): User
    {
        $u = User::where('hak_akses', 'peserta')->first();
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    /** Form registrasi profil render + field lengkap + layout orange */
    public function test_form_registrasi_render_field_lengkap(): void
    {
        $user = $this->freshPeserta();
        $resp = $this->actingAs($user)->get('/peserta/create');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Registrasi', $html);
        $this->assertStringContainsString('name="nama_pt"', $html);
        $this->assertStringContainsString('name="izin"', $html);
        $this->assertStringContainsString('name="no_hp"', $html);
        $this->assertStringContainsString('name="email"', $html);
        $this->assertStringContainsString('name="kswp_npwp"', $html);
        $this->assertStringContainsString('file', $html); // berkas upload
    }

    /** Halaman upload penawaran render + data HPS & field */
    public function test_halaman_upload_penawaran_render(): void
    {
        // Tender uji coba id tinggi, jadwal reset; ambil tender yang punya penawaran.
        $tender = \App\Models\tender::where('default', 0)->latest('id')->first()
            ?? \App\Models\tender::first();

        $resp = $this->actingAs($this->peserta())->get('/penawaran_file/' . $tender->id);
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Upload Penawaran', $html);
        $this->assertStringContainsString('HPS', $html);
    }
}
