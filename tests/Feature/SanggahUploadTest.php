<?php

namespace Tests\Feature;

use App\Models\daftar_peserta;
use App\Models\sanggah;
use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Alur SANGGAH BANDING (SanggahController) — regresi fix:
 * 1. Upload file sanggah tersimpan dengan path benar (folder pakai tender_id, bukan id null).
 * 2. Halaman menampilkan preview & tombol download untuk file yang sudah diupload.
 * 3. User yang belum terdaftar tidak bisa kirim sanggahan.
 */
class SanggahUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function daftarPeserta(): daftar_peserta
    {
        return daftar_peserta::firstOrFail();
    }

    public function test_store_sanggahan_menyimpan_file_dengan_path_benar(): void
    {
        $dp = $this->daftarPeserta();
        $peserta = $dp->peserta;
        $owner = User::find($peserta->user_id);
        $owner->forceFill(['email_verified_at' => now()])->save();

        $file = UploadedFile::fake()->create('sanggahan.pdf', 100, 'application/pdf');

        $response = $this->actingAs($owner)->post('/sanggahan', [
            'keterangan' => 'Kami keberatan atas hasil evaluasi.',
            'peserta' => $peserta->id,
            'tender' => $dp->tender_id,
            'file' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $s = sanggah::where('user_id', $owner->id)
            ->where('peserta_id', $peserta->id)
            ->where('tender_id', $dp->tender_id)
            ->first();

        $this->assertNotNull($s, 'Sanggahan harus tersimpan');
        $this->assertStringStartsWith('Tender/FILE/sanggah/' . $dp->tender_id . '/', $s->file, 'Path file harus memakai folder tender_id');
    }

    public function test_halaman_sanggah_menampilkan_preview_dan_download_file(): void
    {
        $dp = $this->daftarPeserta();
        $peserta = $dp->peserta;
        $owner = User::find($peserta->user_id);
        $owner->forceFill(['email_verified_at' => now()])->save();

        // Buat sanggahan dengan file
        sanggah::create([
            'peserta_id' => $peserta->id,
            'tender_id' => $dp->tender_id,
            'user_id' => $owner->id,
            'keterangan' => 'Sanggahan uji',
            'file' => 'Tender/FILE/sanggah/' . $dp->tender_id . '/sanggah-abc.pdf',
        ]);

        $response = $this->actingAs($owner)->get('/sanggahan/' . $dp->tender_id);
        $response->assertOk();
        $html = $response->getContent();

        $this->assertStringContainsString('File sudah diupload', $html);
        $this->assertStringContainsString('Buka File Sanggahan', $html);
        $this->assertStringContainsString('href="/Tender/FILE/sanggah/' . $dp->tender_id . '/sanggah-abc.pdf"', $html);
        $this->assertStringContainsString('Download', $html);
    }

    public function test_user_belum_terdaftar_tidak_bisa_kirim_sanggahan(): void
    {
        $dp = $this->daftarPeserta();
        $peserta = $dp->peserta;
        $owner = User::find($peserta->user_id);
        $owner->forceFill(['email_verified_at' => now()])->save();

        // Hapus daftar peserta agar user dianggap belum terdaftar di tender tsb
        daftar_peserta::where('tender_id', $dp->tender_id)
            ->where('peserta_id', $peserta->id)
            ->delete();

        $response = $this->actingAs($owner)
            ->from('/sanggahan/' . $dp->tender_id)
            ->post('/sanggahan', [
                'keterangan' => 'Percobaan tanpa daftar',
                'peserta' => $peserta->id,
                'tender' => $dp->tender_id,
                'file' => UploadedFile::fake()->create('x.pdf', 10, 'application/pdf'),
            ]);

        $response->assertRedirect('/sanggahan/' . $dp->tender_id);
        $response->assertSessionHasErrors('msg');
        $this->assertDatabaseMissing('sanggahs', ['user_id' => $owner->id, 'tender_id' => $dp->tender_id]);
    }
}
