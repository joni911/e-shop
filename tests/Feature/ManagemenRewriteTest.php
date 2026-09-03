<?php

namespace Tests\Feature;

use App\Models\managemen;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Rewrite halaman Managemen Perusahaan (tender_user/peserta/managemen/create)
 * ke tema baru (layouts.peserta + komponen x-*). Verifikasi halaman show
 * (tambah) & edit tetap render + tidak menyisakan template adminlte.
 */
class ManagemenRewriteTest extends TestCase
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

    public function test_halaman_tambah_managemen_memakai_tema_baru(): void
    {
        [$user, $profil] = $this->pesertaUser();

        $resp = $this->actingAs($user)->get('/managemen/' . $profil->id);
        $resp->assertOk();

        $html = $resp->getContent();
        $this->assertStringContainsString('Managemen Perusahaan', $html);
        $this->assertStringContainsString('Tambah Managemen Perusahaan', $html);
        $this->assertStringContainsString('name="nama"', $html);
        $this->assertStringContainsString('name="status"', $html);
        $this->assertStringContainsString('name="file1"', $html);
        $this->assertStringContainsString('name="ket1"', $html);
        // komponen tema baru + tanpa sisa adminlte
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringNotContainsString('card card-primary', $html);
        $this->assertStringNotContainsString('adminlte', $html);
    }

    public function test_halaman_edit_managemen_prefill_dan_tema_baru(): void
    {
        [$user, $profil] = $this->pesertaUser();

        $row = new managemen();
        $row->peserta_id = $profil->id;
        $row->tender_id = $profil->tender_id;
        $row->user_id = $user->id;
        $row->nama = 'Pengurus Uji Tema';
        $row->tgl_menjabat = '2024-01-01';
        $row->tgl_berakhir = '2025-01-01';
        $row->ktp = '987654321';
        $row->alamat = 'Jl. Uji No. 1';
        $row->npwp = '00.000.000.0-000.000';
        $row->status = 'Direktur';
        $row->file1 = 'Tender/FILE/uji/sertifikat.pdf';
        $row->ket1 = 'Sertifikat Keahlian';
        $row->save();

        $resp = $this->actingAs($user)->get('/managemen/' . $row->id . '/edit');
        $resp->assertOk();

        $html = $resp->getContent();
        $this->assertStringContainsString('Edit Managemen Perusahaan', $html);
        $this->assertStringContainsString('value="Pengurus Uji Tema"', $html);
        $this->assertStringContainsString('value="Direktur"', $html);
        $this->assertStringContainsString('Sertifikat Keahlian', $html);
        $this->assertStringContainsString('Download sertifikat saat ini', $html);
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringNotContainsString('card card-primary', $html);
    }

    public function test_validasi_store_managemen_tetap_bekerja(): void
    {
        [$user, $profil] = $this->pesertaUser();

        // Kirim tanpa file1 (server mewajibkan) → redirect balik + error
        $resp = $this->actingAs($user)->post('/managemen', [
            'id' => $profil->id,
            'nama' => 'Pengurus Tanpa File',
        ]);
        $resp->assertSessionHasErrors(['file1', 'tgl_menjabat', 'tgl_berakhir', 'ktp', 'alamat', 'npwp', 'status']);
        $this->assertTrue(session()->has('errors'));
    }
}
