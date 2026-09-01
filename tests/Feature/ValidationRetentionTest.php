<?php

namespace Tests\Feature;

use App\Models\daftar_peserta;
use App\Models\peserta;
use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Verifikasi: saat validasi registrasi gagal, input yang sudah diketik
 * TIDAK hilang (retensi via old()) dan error per-field tampil.
 */
class ValidationRetentionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function freshPeserta(): User
    {
        $u = User::create([
            'name' => 'PT Retensi',
            'email' => 'retensi@pengadaan.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    public function test_validasi_gagal_tetap_menyimpan_input_dan_menampilkan_error_per_field(): void
    {
        $user = $this->freshPeserta();
        $tenderDefault = tender::where('default', 1)->firstOrFail();

        $payload = [
            'id' => $tenderDefault->id,
            'izin' => 'NIB',
            'nomor_izin' => '8129998887776',
            'izin_berlaku' => '2050-01-01',
            'instansi_pemberi' => 'Kemenperin',
            'kualifikasi' => 'Menengah',
            'klasifikasi' => 'Bangunan',
            'nama_pt' => '', // ← sengaja kosong
            'no_hp' => '08123456789',
            'email' => 'retensi@pengadaan.test',
            'alamat' => 'Jl Uji No 1',
            'no_akta' => '001',
            'tgl_akta' => '2020-01-01',
            'notaris' => 'Notaris A',
            'no_aktab' => '002',
            'tgl_aktab' => '2021-01-01',
            'notaris_b' => 'Notaris B',
            'kswp_npwp' => '123456789012345',
            'kswp_nama' => 'PT Uji',
        ];

        $response = $this->actingAs($user)
            ->from('/peserta/create')
            ->post('/peserta', $payload);

        $response->assertSessionHasErrors('nama_pt');
        $response->assertSessionHasInput('izin'); // input lama harus tersimpan di session

        $html = $this->get('/peserta/create')->getContent();

        // Error per-field spesifik
        $this->assertStringContainsString('Nama perusahaan wajib diisi.', $html);
        // Retensi: nilai yang diketik tetap tampil di input
        $this->assertMatchesRegularExpression('/name="izin"[^>]*value="NIB"/', $html);
        $this->assertMatchesRegularExpression('/name="no_hp"[^>]*value="08123456789"/', $html);
        $this->assertMatchesRegularExpression('/name="email"[^>]*value="retensi@pengadaan.test"/', $html);
        $this->assertMatchesRegularExpression('/name="kswp_npwp"[^>]*value="123456789012345"/', $html);
    }
}
