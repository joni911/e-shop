<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Halaman berkas peserta `peserta/{id}/file_tender/{pid}` (PesertaController@show_file_peserta)
 * — rewrite dari AdminLTE ke layout dinamis + komponen + tab Bootstrap 5 + modal preview file.
 */
class PesertaFileRewriteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function admin(): User
    {
        $u = User::where('hak_akses', 'admin')->first()
            ?? User::create(['name' => 'Admin PF', 'email' => 'admin-pf@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    private function pesertaUrl(): string
    {
        $p = \App\Models\peserta::first();
        return '/peserta/' . $p->id . '/file_tender/' . $p->tender_id;
    }

    public function test_admin_lihat_berkas_peserta_renders_shell_tabs(): void
    {
        $resp = $this->actingAs($this->admin())->get($this->pesertaUrl());
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('File Peserta', $html);
        $this->assertStringContainsString('Persyaratan Kualifikasi', $html);
        $this->assertStringContainsString('Administrasi', $html);
        $this->assertStringContainsString('Evaluasi Teknis', $html);
        $this->assertStringContainsString('Harga', $html);
        $this->assertStringContainsString('Penilaian', $html);
        $this->assertStringContainsString('Nama Perusahaan', $html);
        $this->assertStringContainsString('Penawaran Peserta', $html);
        // tidak boleh ada sisa AdminLTE
        $this->assertStringNotContainsString('x-adminlte', $html);
        $this->assertStringNotContainsString('adminlte::page', $html);

        // id modal harus UNIK (regression: dulu 'fp-{id}' bisa duplikat antar konteks
        // → getElementById mengembalikan modal tab pertama walau klik di tab lain)
        preg_match_all('/data-modal="([^"]+)"/', $html, $mt);
        $this->assertNotEmpty($mt[1] || [], 'Tidak ada trigger modal ditemukan');
        $this->assertCount(count(array_unique($mt[1])), $mt[1], 'data-modal duplikat ditemukan');
        foreach ($mt[1] as $tid) {
            preg_match_all('/id="' . preg_quote($tid, '/') . '"/', $html, $mm);
            $this->assertCount(1, $mm[0], 'Modal id ' . $tid . ' muncul lebih dari sekali');
        }
    }

    public function test_peserta_lihat_berkas_renders_shell_peserta(): void
    {
        $p = User::where('hak_akses', 'peserta')->first();
        $p->forceFill(['email_verified_at' => now()])->save();
        $resp = $this->actingAs($p)->get($this->pesertaUrl());
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('File Peserta', $html);
    }
}