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

    /** Modal BS5 markup muncul di detail (x-modal component) */
    public function test_detail_tender_punya_markup_modal(): void
    {
        $peserta = $this->peserta();
        $tender = tender::first();
        $html = $this->actingAs($peserta)->get('/tender_home/' . $tender->id)->getContent();

        // Komponen x-modal selalu render modal fade (BS5) bila condition terpenuhi.
        // Assert markup modal component berfungsi di halaman ini.
        $this->assertStringContainsString('modal', $html);
    }
}
