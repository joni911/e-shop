<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F0 — Foundation: verifikasi layout per-role & komponen reusable render tanpa error.
 */
class UiFoundationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function admin(): User
    {
        $u = User::where('hak_akses', 'admin')->first() ?? User::create([
            'name' => 'Admin F0',
            'email' => 'admin-f0@pbj.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'admin',
        ]);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    private function peserta(): User
    {
        $u = User::where('hak_akses', 'peserta')->first() ?? User::create([
            'name' => 'Peserta F0',
            'email' => 'peserta-f0@pbj.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    /** Layout guest (auth) merender komponen */
    public function test_layout_guest_renders_komponen(): void
    {
        $html = $this->get('/ui-preview')->getContent();
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('card-header', $html);
        $this->assertStringContainsString('form-select', $html);
        $this->assertStringContainsString('alert alert-success', $html);
        $this->assertStringContainsString('table-wrap', $html);
    }

    /** Layout admin render (via route yang me-render layout admin setelah F1) */
    public function test_layout_admin_body_class_dan_menu(): void
    {
        // Untuk F0, layout admin belum dipakai route. Verifikasi via render manual view.
        $html = view('layouts.admin')->render();
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('sidebar-nav', $html);
        $this->assertStringContainsString('Master', $html); // menu admin
    }

    public function test_layout_peserta_menu_terbatas(): void
    {
        $html = view('layouts.peserta')->render();
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Sanggahan', $html);
        $this->assertStringNotContainsString('Master', $html); // peserta tidak lihat master
    }

    /** Komponen render dalam konteks request nyata (errors bag tersedia) */
    public function test_komponen_render_dalam_request(): void
    {
        $html = $this->get('/ui-preview')->getContent();
        $this->assertStringContainsString('PT Maju Jaya', $html);
        $this->assertStringContainsString('Kontrak A', $html);
        $this->assertStringContainsString('value="2"', $html);
    }
}
