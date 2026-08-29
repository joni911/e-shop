<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F5 (subset) — Master Tahapan: index/create/edit rewrite layout admin.
 * Fix utama: create TIDAK lagi crash "Undefined variable $data".
 */
class TahapanMasterTest extends TestCase
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
            ?? User::create(['name' => 'Admin T', 'email' => 'admin-t@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    public function test_master_tahapan_index_renders_shell(): void
    {
        $resp = $this->actingAs($this->admin())->get('/tahapan');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Daftar Tahapan', $html);
        $this->assertStringContainsString('table-wrap', $html);
        $this->assertStringContainsString('/tahapan/create', $html);
    }

    public function test_master_tahapan_create_tidak_crash(): void
    {
        // Regression: dulu crash "Undefined variable $data" (part/form pakai $data->status)
        $resp = $this->actingAs($this->admin())->get('/tahapan/create');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Tambah Tahapan', $html);
        $this->assertStringContainsString('name="nama"', $html);
        $this->assertStringContainsString('name="awal"', $html);
        $this->assertStringContainsString('name="akhir"', $html);
        $this->assertStringContainsString('name="status"', $html);
        $this->assertStringContainsString('form-select', $html);
    }

    public function test_master_tahapan_edit_menampilkan_prefill(): void
    {
        $tahapan = \App\Models\tahapan::first();
        $resp = $this->actingAs($this->admin())->get('/tahapan/' . $tahapan->id . '/edit');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Edit Tahapan', $html);
        $this->assertStringContainsString('value="' . $tahapan->nama . '"', $html);
    }
}