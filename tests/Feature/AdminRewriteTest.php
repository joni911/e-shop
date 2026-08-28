<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F4 — Admin: verifikasi kelola tender, dashboard pemeriksaan render
 * 200 + shell orange + data dipertahankan (Q2).
 */
class AdminRewriteTest extends TestCase
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
            ?? User::create(['name' => 'Admin F4', 'email' => 'admin-f4@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    public function test_tender_admin_index_renders_shell(): void
    {
        $resp = $this->actingAs($this->admin())->get('/tender_admin');
        $resp->assertOk();
        $html = $resp->getContent();
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Kelola Tender', $html);
        $this->assertStringContainsString('table-wrap', $html);
    }

    public function test_tender_admin_create_renders_form(): void
    {
        $resp = $this->actingAs($this->admin())->get('/tender_admin/create');
        $resp->assertOk();
        $html = $resp->getContent();
        $this->assertStringContainsString('form-select', $html);
        $this->assertStringContainsString('name="nama"', $html);
        $this->assertStringContainsString('Jenis Kontrak', $html);
    }

    public function test_tender_admin_edit_renders(): void
    {
        $tender = \App\Models\tender::first();
        $resp = $this->actingAs($this->admin())->get('/tender_admin/' . $tender->id . '/edit');
        $resp->assertOk();
        $this->assertStringContainsString('ui-shell', $resp->getContent());
    }

    public function test_dashboard_index_renders(): void
    {
        $resp = $this->actingAs($this->admin())->get('/dashboard');
        $resp->assertOk();
        $html = $resp->getContent();
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Pemeriksaan', $html);
        $this->assertStringContainsString('table-wrap', $html);
    }

    /** Admin yang login ke /home harus melihat MENU ADMIN (Kelola Tender, Master, Pemeriksaan) */
    public function test_admin_home_menampilkan_menu_admin(): void
    {
        $resp = $this->actingAs($this->admin())->get('/home');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Kelola Tender', $html); // menu admin
        $this->assertStringContainsString('Master', $html);       // menu admin
        $this->assertStringNotContainsString('Sanggahan', $html); // menu peserta tidak ada di admin
    }

    /** Peserta login ke /home harus melihat MENU PESERTA (bukan admin) */
    public function test_peserta_home_menampilkan_menu_peserta(): void
    {
        $p = User::where('hak_akses', 'peserta')->first();
        $p->forceFill(['email_verified_at' => now()])->save();
        $resp = $this->actingAs($p)->get('/home');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Sanggahan', $html); // menu peserta
        $this->assertStringNotContainsString('Kelola Tender', $html); // menu admin tidak ada di peserta
    }
}
