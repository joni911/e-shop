<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Sidebar dinamis per role (layouts.app): halaman shared (perubahan, registrasi peserta,
 * upload penawaran) harus menampilkan sidebar sesuai role — admin dapat menu admin,
 * peserta dapat menu peserta (regression: dulu admin mendapat sidebar peserta).
 */
class SidebarRoleTest extends TestCase
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
            ?? User::create(['name' => 'Admin S', 'email' => 'admin-s@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    private function peserta(): User
    {
        $u = User::where('hak_akses', 'peserta')->first();
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    public function test_admin_di_halaman_shared_mendapat_sidebar_admin(): void
    {
        // Admin punya profil peserta -> redirect ke edit, layout dinamis (admin)
        $resp = $this->actingAs($this->admin())->get('/peserta/create');
        $resp->assertOk();
        $html = $resp->getContent();

        // Sidebar admin
        $this->assertStringContainsString('Kelola Tender', $html);
        $this->assertStringContainsString('Pemeriksaan', $html);
        // Sidebar peserta TIDAK muncul
        $this->assertStringNotContainsString('Sanggahan', $html);
    }

    public function test_peserta_di_halaman_shared_mendapat_sidebar_peserta(): void
    {
        // Peserta dengan profil -> /peserta/create redirect ke edit (layout dinamis peserta)
        $p = $this->peserta();
        $resp = $this->actingAs($p)->get('/peserta/create');
        if ($resp->isRedirect()) {
            $resp = $this->actingAs($p)->get($resp->headers->get('Location'));
        }
        $resp->assertOk();
        $html = $resp->getContent();

        // Sidebar peserta
        $this->assertStringContainsString('Sanggahan', $html);
        // Sidebar admin TIDAK muncul
        $this->assertStringNotContainsString('Kelola Tender', $html);
        $this->assertStringNotContainsString('Pemeriksaan', $html);
    }

    public function test_admin_di_registrasi_peserta_mendapat_sidebar_admin(): void
    {
        // Admin yang belum punya profil peserta -> halaman registrasi create
        $resp = $this->actingAs($this->admin())->get('/peserta/create');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('Kelola Tender', $html);
        $this->assertStringNotContainsString('Sanggahan', $html);
    }

    public function test_halaman_konfirmasi_password_menggunakan_layout_guest(): void
    {
        $resp = $this->actingAs($this->peserta())->get('/password/confirm');
        $resp->assertOk();
        $html = $resp->getContent();

        // Layout guest: tanpa sidebar & tanpa menu admin/peserta
        $this->assertStringContainsString('Konfirmasi Password', $html);
        $this->assertStringNotContainsString('sidebar-nav', $html);
    }
}
