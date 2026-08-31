<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Managemen: kolom KTP diganti No Rekening + Master ID (permintaan pengguna).
 */
class ManagemenRekeningTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function peserta(): User
    {
        $p = User::where('hak_akses', 'peserta')->first();
        $p->forceFill(['email_verified_at' => now()])->save();
        return $p;
    }

    public function test_managemen_show_menampilkan_no_rekening_dan_master_id(): void
    {
        $p = \App\Models\peserta::where('user_id', $this->peserta()->id)->first();
        $resp = $this->actingAs($this->peserta())->get('/managemen/' . $p->id);
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('name="no_rekening"', $html);
        $this->assertStringContainsString('name="master_id"', $html);
        $this->assertStringContainsString('No Rekening', $html);
        $this->assertStringContainsString('Master ID', $html);
        $this->assertStringNotContainsString('ktp', strtolower($html));
    }

    public function test_store_managemen_menyimpan_no_rekening_dan_master_id(): void
    {
        $user = $this->peserta();
        $p = \App\Models\peserta::where('user_id', $user->id)->first();
        $resp = $this->actingAs($user)->post('/managemen', [
            'id' => $p->id,
            'tender_id' => $p->tender_id,
            'nama' => 'Pengurus Tes',
            'tgl_menjabat' => '2020-01-01',
            'tgl_berakhir' => '2030-01-01',
            'no_rekening' => '1234567890',
            'master_id' => '500001',
            'alamat' => 'Jl. Tes No. 1',
            'npwp' => '123456789012345',
            'status' => 'Direktur',
            'file1' => \Illuminate\Http\UploadedFile::fake()->create('sertifikat.pdf', 10),
            'ket1' => 'Sertifikat 1',
        ]);
        $resp->assertRedirect();
        $this->assertDatabaseHas('managemens', [
            'no_rekening' => '1234567890',
            'master_id' => '500001',
        ]);
        $this->assertDatabaseMissing('managemens', ['ktp' => '1234567890']);
    }
}
