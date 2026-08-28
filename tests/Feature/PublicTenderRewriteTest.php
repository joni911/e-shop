<?php

namespace Tests\Feature;

use App\Models\peserta;
use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F2 — Publik & Beranda Peserta: verifikasi tender_home (beranda & detail)
 * render 200 + data lama dipertahankan (Q2: data tidak berkurang).
 */
class PublicTenderRewriteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    /** Cari user peserta yang punya profil peserta */
    private function peserta(): User
    {
        $u = User::where('hak_akses', 'peserta')->first();
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    /** Beranda tender render + marker shell + kartu */
    public function test_beranda_render_data(): void
    {
        $resp = $this->actingAs($this->peserta())->get('/tender_home');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Daftar Tender', $html);
        $this->assertStringContainsString('tender-card', $html);
        $this->assertStringContainsString('tender-card-title', $html);
    }

    /** Detail tender render + field data inti (Q2: tidak berkurang) */
    public function test_detail_tender_render_field_inti(): void
    {
        $peserta = $this->peserta();
        // Ambil tender yang pasti ada di seeder
        $tender = tender::first();
        $resp = $this->actingAs($peserta)->get('/tender_home/' . $tender->id);
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('tender-detail-grid', $html);
        $this->assertStringContainsString('Jenis Pengadaan', $html);
        $this->assertStringContainsString('Jenis Kontrak', $html);
        $this->assertStringContainsString('Metode Pengadaan', $html);
        $this->assertStringContainsString('HPS', $html);
    }

    /** Modal custom tema orange muncul di detail (x-modal component) */
    public function test_detail_tender_punya_markup_modal(): void
    {
        $peserta = $this->peserta();
        $tender = tender::first();
        $html = $this->actingAs($peserta)->get('/tender_home/' . $tender->id)->getContent();

        $this->assertStringContainsString('x-modal-overlay', $html);
        $this->assertStringContainsString('data-modal=', $html);
        $this->assertStringContainsString('data-modal-close=', $html);
    }

    /** Status badge menampilkan $d->stn asli (bukan hardcode Draft) */
    public function test_status_badge_tampilkan_nama_status_asli(): void
    {
        $resp = $this->actingAs($this->peserta())->get('/tender_home');
        $resp->assertOk();
        $html = $resp->getContent();

        // Ambil status tender dari seeder & pastikan label asli tampil
        $statusList = \App\Models\status_tender::pluck('nama');
        $found = false;
        foreach ($statusList as $stn) {
            if (str_contains($html, $stn)) { $found = true; break; }
        }
        $this->assertTrue($found, 'Seharusnya label status asli tampil di beranda');
    }

    /** Peserta BISA akses perubahan.show (transparansi jadwal) */
    public function test_peserta_bisa_akses_perubahan_show(): void
    {
        $tahapan = \App\Models\tahapan::first();
        if (!$tahapan) { $this->markTestSkipped('Tidak ada tahapan'); }

        $resp = $this->actingAs($this->peserta())->get('/perubahan/' . $tahapan->id);
        $resp->assertOk();
        $this->assertStringContainsString('Perubahan', $resp->getContent());
    }

    /** Peserta TIDAK bisa akses mutasi perubahan (create) — 403 */
    public function test_peserta_dilarang_akses_mutasi_perubahan(): void
    {
        $this->actingAs($this->peserta())->get('/perubahan/create')->assertForbidden();
    }

    /** Admin tetap bisa akses perubahan create */
    public function test_admin_bisa_akses_perubahan_create(): void
    {
        $admin = \App\Models\User::where('hak_akses', 'admin')->first();
        $admin->forceFill(['email_verified_at' => now()])->save();
        $this->actingAs($admin)->get('/perubahan/create')->assertOk();
    }
}
