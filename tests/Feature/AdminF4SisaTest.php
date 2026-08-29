<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F4 (sisa) — Atur Tahapan Tender & Daftar Peserta (pemeriksaan detail).
 * Verifikasi render 200 + shell orange + data dipertahankan (Q2).
 */
class AdminF4SisaTest extends TestCase
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
            ?? User::create(['name' => 'Admin F4s', 'email' => 'admin-f4s@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    public function test_atur_tahapan_renders_shell_dan_form(): void
    {
        $tender = \App\Models\tender::first();
        $resp = $this->actingAs($this->admin())->get('/tender_admin/tahapan/' . $tender->id);
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Atur Tahapan Tender', $html);
        $this->assertStringContainsString('Tambah Tahapan Baru', $html);
        $this->assertStringContainsString('name="nama"', $html);
        $this->assertStringContainsString('name="status"', $html);
        $this->assertStringContainsString('form-select', $html);
        $this->assertStringContainsString('name="awal"', $html);
        $this->assertStringContainsString('name="akhir"', $html);
    }

    public function test_atur_tahapan_menampilkan_tender_dan_data_existing(): void
    {
        $tender = \App\Models\tender::first();
        $tahapan = \App\Models\tahapan::where('tender_id', $tender->id)->first();

        $resp = $this->actingAs($this->admin())->get('/tender_admin/tahapan/' . $tender->id);
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('Daftar Tahapan', $html);
        $this->assertStringContainsString('badge', $html);
        $this->assertStringContainsString($tender->nama, $html);
        if ($tahapan) {
            $this->assertStringContainsString($tahapan->nama, $html);
        }
    }

    public function test_tambah_tahapan_melalui_route_store(): void
    {
        $tender = \App\Models\tender::first();
        $resp = $this->actingAs($this->admin())->post('/tahapan', [
            'id' => $tender->id,
            'nama' => 'Tahap Tes F4',
            'awal' => now()->toDateString(),
            'akhir' => now()->addDays(7)->toDateString(),
            'status' => 1,
        ]);
        $resp->assertRedirect();
        $this->assertDatabaseHas('tahapans', [
            'tender_id' => $tender->id,
            'nama' => 'Tahap Tes F4',
            'status' => 1,
        ]);
    }

    public function test_dashboard_show_renders_daftar_peserta(): void
    {
        $tender = \App\Models\tender::first();
        $resp = $this->actingAs($this->admin())->get('/dashboard/' . $tender->id);
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Daftar Peserta Tender', $html);
        $this->assertStringContainsString('table-wrap', $html);
        $this->assertStringContainsString($tender->nama, $html);
    }
}