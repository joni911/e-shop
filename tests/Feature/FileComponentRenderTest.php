<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Verifikasi komponen x-file (upgrade preview + status) merender
 * dengan benar di halaman edit peserta & registrasi.
 */
class FileComponentRenderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_edit_peserta_menampilkan_status_badge_dan_download(): void
    {
        $u = User::where('hak_akses', 'peserta')->first();
        $u->forceFill(['email_verified_at' => now()])->save();

        $resp = $this->actingAs($u)->get('/peserta/1/edit');
        $resp->assertOk();
        $html = $resp->getContent();

        // Badge status "Sudah diisi" untuk file yang sudah diupload
        $this->assertStringContainsString('Sudah diisi', $html);
        // Tombol download file saat ini
        $this->assertStringContainsString('Download file saat ini', $html);
        // Preview container ada
        $this->assertStringContainsString('data-preview', $html);
    }

    public function test_registrasi_form_menampilkan_badge_belum_diisi(): void
    {
        $u = User::create([
            'name' => 'PT Render Baru',
            'email' => 'render-baru@pengadaan.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $u->forceFill(['email_verified_at' => now()])->save();

        $resp = $this->actingAs($u)->get('/peserta/create');
        $resp->assertOk();
        $html = $resp->getContent();

        // Badge "Belum diisi" untuk berkas wajib yang belum diupload
        $this->assertStringContainsString('Belum diisi', $html);
        $this->assertStringContainsString('required', $html);
    }
}
