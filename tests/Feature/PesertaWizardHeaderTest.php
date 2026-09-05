<?php

namespace Tests\Feature;

use App\Models\managemen;
use App\Models\tender;
use App\Models\User;
use App\Services\PesertaWizardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Header wizard peserta 7 langkah (Data Perusahaan → Administrasi) yang tampil
 * di atas SEMUA halaman langkah kelengkapan — PRD docs/PRD_peserta_wizard_header_7langkah.md
 *
 * Keputusan: (1) langkah aktif bisa diklik, (2) bebas lompat tanpa gating,
 * (3) stepper 7 langkah termasuk Administrasi.
 */
class PesertaWizardHeaderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function pesertaUser(): array
    {
        $user = User::where('hak_akses', 'peserta')->first();
        $user->forceFill(['email_verified_at' => now()])->save();
        $profil = $user->peserta;
        $this->assertNotNull($profil, 'Seeder harus menyediakan profil peserta');
        return [$user, $profil];
    }

    // ── Slice A: service ──────────────────────────────────────────────────

    public function test_service_mengembalikan_tujuh_langkah_berurutan(): void
    {
        [, $profil] = $this->pesertaUser();

        $steps = PesertaWizardService::steps($profil);

        $this->assertCount(7, $steps);
        $this->assertSame(
            ['Data Perusahaan', 'Pengalaman', 'Tenaga Ahli', 'Peralatan', 'Pekerjaan Berjalan', 'Managemen', 'Administrasi'],
            $steps->pluck('label')->all()
        );
        // Step 1 selalu done (profil sudah ada)
        $this->assertTrue($steps[0]['done']);
        // URL dinamis via route() — tanpa URL absolut
        foreach ($steps as $s) {
            $this->assertStringNotContainsString('127.0.0.1', $s['url']);
            $this->assertStringStartsWith('http', $s['url']);
        }
    }

    public function test_service_menandai_langkah_aktif_sesuai_key(): void
    {
        [, $profil] = $this->pesertaUser();

        $steps = PesertaWizardService::steps($profil, 'managemen');
        $this->assertTrue($steps->firstWhere('key', 'managemen')['active']);
        $this->assertFalse($steps->firstWhere('key', 'pengalaman')['active']);

        // Tanpa activeKey → tidak ada penanda aktif (mode hub)
        $hub = PesertaWizardService::steps($profil);
        $this->assertFalse($hub->contains('active', true));
    }

    // ── Slice B: hub "Tender Saya" ───────────────────────────────────────

    public function test_hub_menampilkan_tujuh_langkah_termasuk_administrasi(): void
    {
        [$user, $profil] = $this->pesertaUser();

        $resp = $this->actingAs($user)->get('/peserta/tenders');
        $resp->assertOk();

        $html = $resp->getContent();
        $this->assertStringContainsString('Administrasi', $html);
        $this->assertStringContainsString('administrasi_list/' . $profil->id, $html);
        // Stepper lengkap: jumlah label langkah = 7
        $labels = ['Data Perusahaan', 'Pengalaman', 'Tenaga Ahli', 'Peralatan', 'Pekerjaan Berjalan', 'Managemen', 'Administrasi'];
        foreach ($labels as $l) {
            $this->assertStringContainsString($l, $html);
        }
        // Tidak ada tautan absolut & tidak ada sisa adminlte
        $this->assertStringNotContainsString('127.0.0.1', $html);
        $this->assertStringNotContainsString('adminlte', $html);
    }

    public function test_hub_memberi_centang_pada_langkah_yang_sudah_diisi(): void
    {
        [$user, $profil] = $this->pesertaUser();

        $row = new managemen();
        $row->peserta_id = $profil->id;
        $row->tender_id = $profil->tender_id;
        $row->user_id = $user->id;
        $row->nama = 'Pengurus Uji Stepper';
        $row->tgl_menjabat = '2024-01-01';
        $row->tgl_berakhir = '2025-01-01';
        $row->ktp = '987654321';
        $row->alamat = 'Jl. Uji No. 1';
        $row->npwp = '00.000.000.0-000.000';
        $row->status = 'Direktur';
        $row->file1 = 'Tender/FILE/uji/sertifikat.pdf';
        $row->ket1 = 'Sertifikat Keahlian';
        $row->save();

        // Service: step managemen berubah done setelah ada record
        $steps = PesertaWizardService::steps($profil);
        $this->assertTrue($steps->firstWhere('key', 'managemen')['done']);
    }

    // ── Slice C: stepper di tiap halaman langkah ─────────────────────────

    public static function halamanLangkahProvider(): array
    {
        return [
            'data-perusahaan'    => ['/peserta/{id}/edit', 'perusahaan', 'Data Perusahaan'],
            'pengalaman'         => ['/pengalaman/{id}', 'pengalaman', 'Pengalaman'],
            'tenaga-ahli'        => ['/tenagaahli/{id}', 'tenaga', 'Tenaga Ahli'],
            'peralatan'          => ['/peralatan/{id}', 'peralatan', 'Peralatan'],
            'pekerjaan-berjalan' => ['/pekerjaan_berjalan/{id}', 'pekerjaan', 'Pekerjaan Berjalan'],
            'managemen'          => ['/managemen/{id}', 'managemen', 'Managemen'],
            'administrasi'       => ['/administrasi_list/{id}', 'administrasi', 'Administrasi'],
        ];
    }

    /**
     * @dataProvider halamanLangkahProvider
     */
    public function test_tiap_halaman_langkah_menampilkan_stepper_dengan_active_sesuai(string $path, string $activeKey, string $activeLabel): void
    {
        [$user, $profil] = $this->pesertaUser();

        // Halaman administrasi bersifat per-tender → pastikan tender fallback tersedia
        if ($activeKey === 'administrasi' && !$profil->tender_id) {
            $tender = tender::first();
            $this->assertNotNull($tender, 'Seeder harus menyediakan tender');
            $profil->tender_id = $tender->id;
            $profil->save();
        }

        $url = str_replace('{id}', (string) $profil->id, $path);
        $resp = $this->actingAs($user)->get($url);
        $resp->assertOk();

        $html = $resp->getContent();
        // Stepper hadir
        $this->assertStringContainsString('class="steps', $html);
        // Penanda langkah aktif terpasang
        $this->assertStringContainsString('active', $html);
        $this->assertStringContainsString($activeLabel, $html);
        // Semua 7 label langkah dirender (navigasi lengkap)
        foreach (['Data Perusahaan', 'Pengalaman', 'Tenaga Ahli', 'Peralatan', 'Pekerjaan Berjalan', 'Managemen', 'Administrasi'] as $label) {
            $this->assertStringContainsString($label, $html);
        }
        // URL dinamis, bebas lompat: tidak ada gating/disabled, tidak ada URL absolut
        $this->assertStringNotContainsString('disabled', $html);
        $this->assertStringNotContainsString('127.0.0.1', $html);
    }

    public function test_langkah_aktif_tetap_berupa_tautan(): void
    {
        [$user, $profil] = $this->pesertaUser();

        $resp = $this->actingAs($user)->get('/pengalaman/' . $profil->id);
        $resp->assertOk();

        $html = $resp->getContent();
        // Langkah aktif (Pengalaman) dibungkus <a class="step-link"> → tetap bisa diklik
        $this->assertMatchesRegularExpression(
            '/<a class="step-link"[^>]*href="[^"]*pengalaman[^"]*"[^>]*>.*?Pengalaman/s',
            $html
        );
        // Lompat balik ke Data Perusahaan tetap tersedia sebagai tautan
        $this->assertMatchesRegularExpression(
            '/<a class="step-link"[^>]*href="[^"]*peserta\/' . $profil->id . '\/edit[^"]*"[^>]*>.*?Data Perusahaan/s',
            $html
        );
    }
}
