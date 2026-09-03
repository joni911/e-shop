<?php

namespace Tests\Feature;

use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Header wizard "Langkah Pengaturan Tender" — partial terpusat
 * (tender_admin/part/tender-setup-steps.blade.php) tampil konsisten di
 * 7 halaman setup tender dengan 1 badge aktif (non-klik) + 6 tautan
 * route() dinamis (tanpa URL absolut hardcoded).
 */
class SetupWizardHeaderTest extends TestCase
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
            ?? User::create(['name' => 'Admin W', 'email' => 'admin-w@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    /** Sumber data: url halaman + langkah aktif yang diharapkan (1..7). */
    public static function wizardPages(): array
    {
        return [
            'data-tender'   => ['/tender_admin/%d/edit', 1],
            'tahapan'       => ['/tender_admin/tahapan/%d', 2],
            'syarat'        => ['/tender_admin/syarat/%d', 3],
            'file-tender'   => ['/tender_file/%d', 4],
            'persyaratan'   => ['/tender_persyarat/tender/%d', 5],
            'penawaran'     => ['/penawaran/tender/%d', 6],
            'administrasi'  => ['/administrasi/tender/%d', 7],
        ];
    }

    private static function labels(): array
    {
        return [
            1 => 'Data Tender',
            2 => 'Tahapan',
            3 => 'Syarat',
            4 => 'File Tender',
            5 => 'Persyaratan & Penawaran',
            6 => 'Penawaran',
            7 => 'Administrasi',
        ];
    }

    /** Potong hanya deretan badge wizard (dalam d-flex) agar tidak kena badge lain di halaman. */
    private function wizardRegion(string $html): string
    {
        $title = strpos($html, 'Langkah Pengaturan Tender');
        $this->assertNotFalse($title, 'Judul wizard tidak ditemukan');
        $flex = strpos($html, '<div class="d-flex flex-wrap gap-2">', $title);
        $this->assertNotFalse($flex, 'Kontainer badge wizard tidak ditemukan');
        $end = strpos($html, '</div>', $flex);
        $this->assertNotFalse($end, 'Penutup badge wizard tidak ditemukan');
        return substr($html, $flex, $end - $flex);
    }

    /**
     * @dataProvider wizardPages
     */
    public function test_wizard_header_tampil_dengan_satu_badge_aktif(string $urlPattern, int $active): void
    {
        $tender = tender::first();
        $this->assertNotNull($tender, 'Seeder harus menyediakan data tender');

        $url = sprintf($urlPattern, $tender->id);
        $resp = $this->actingAs($this->admin())->get($url);
        $resp->assertOk();

        $region = self::wizardRegion($resp->getContent());

        // Tepat 1 badge aktif (non-klik) + 6 tautan langkah lain
        $this->assertSame(1, substr_count($region, 'badge badge-primary px-3 py-2'), "Harus ada tepat 1 langkah aktif di $url");
        $this->assertSame(6, substr_count($region, 'badge badge-default px-3 py-2'), "Harus ada 6 tautan langkah lain di $url");

        // Semua 7 label muncul (entity & -> &amp; di-decode dulu)
        $decoded = html_entity_decode($region, ENT_QUOTES | ENT_HTML5);
        foreach (self::labels() as $n => $label) {
            $this->assertStringContainsString($n . '. ' . $label, $decoded, "Label langkah $n tidak muncul di $url");
        }

        // Langkah aktif harus <span> non-klik; label lain harus <a> (route dinamis)
        $activeLabel = htmlspecialchars(self::labels()[$active], ENT_QUOTES, 'UTF-8');
        $this->assertMatchesRegularExpression(
            '/<span class="badge badge-primary px-3 py-2"><i class="[^"]*"><\/i> ' . $active . '\. ' . preg_quote($activeLabel, '/') . '<\/span>/',
            $region,
            "Langkah aktif '$activeLabel' harus berupa badge non-klik di $url"
        );
        $this->assertMatchesRegularExpression(
            '/<a href="[^"]*\/[^"]*" class="badge badge-default/',
            $region,
            "Tautan langkah lain harus memakai href (route) di $url"
        );

        // Tidak boleh ada URL absolut hardcoded 127.0.0.1 di area wizard
        $this->assertStringNotContainsString('127.0.0.1', $region, "Ada URL absolut hardcoded di wizard $url");
    }

    public function test_wizard_hanya_muncul_saat_ada_tender(): void
    {
        // Halaman create (belum ada id tender) tidak boleh crash — partial tak dirender tanpa $tender
        $resp = $this->actingAs($this->admin())->get('/tender_admin/create');
        $resp->assertOk();
        $this->assertStringNotContainsString('Langkah Pengaturan Tender', $resp->getContent());
    }
}
