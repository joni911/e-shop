<?php

namespace Tests\Feature;

use App\Models\penawaran;
use App\Models\penawaran_peserta;
use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Alur upload PENAWARAN peserta (/penawaran_peserta store).
 */
class PenawaranPesertaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_store_menolak_gracefully_saat_penawaran_tender_belum_disiapkan()
    {
        // Tender 3 TIDAK punya record penawarans -> controller harus redirect + error, bukan 500.
        $user = User::find(2);
        $t = tender::find(3);

        $response = $this->actingAs($user)
            ->from('/penawaran_file/3')
            ->post('/penawaran_peserta', ['id' => 3, 'penawaran' => 1000000]);

        $response->assertRedirect('/penawaran_file/3');
        $response->assertSessionHasErrors('msg');
        $this->assertDatabaseMissing('penawaran_pesertas', ['tender_id' => 3, 'user_id' => 2]);
    }

    public function test_store_menyimpan_penawaran_dan_semua_file_saat_penawaran_ada()
    {
        // Tender 5 punya penawarans + penawaran_files dari TenderTestingSeeder.
        $user = User::find(2);
        $penawaran = penawaran::where('tender_id', 5)->firstOrFail();

        $payload = ['id' => 5, 'penawaran' => 1445000000];
        foreach ($penawaran->penawaran_file as $pf) {
            $payload['file_' . $pf->id] = UploadedFile::fake()->create('penawaran.pdf', 100, 'application/pdf');
        }

        $response = $this->actingAs($user)->post('/penawaran_peserta', $payload);

        $response->assertStatus(302);
        $this->assertDatabaseHas('penawaran_pesertas', [
            'tender_id' => 5,
            'user_id' => 2,
            'peserta_id' => 1,
            'penawaran' => '1445000000',
        ]);
        $pp = penawaran_peserta::where('tender_id', 5)->where('user_id', 2)->first();
        $this->assertSame(
            $penawaran->penawaran_file->count(),
            $pp->penawaran_peserta_file()->count(),
            'Semua file penawaran wajib harus tersimpan'
        );
    }

    public function test_penawaran_file_show_menampilkan_hps_dan_file_wajib()
    {
        // Tender 5: hps & penawaran_files harus tampil di halaman (bukan 0/kosong).
        $user = User::find(2);

        $response = $this->actingAs($user)->get('/penawaran_file/5');

        $response->assertStatus(200);
        $response->assertSee('1.450.000.000'); // HPS 1.450.000.000
        $pf = penawaran::where('tender_id', 5)->firstOrFail()->penawaran_file->first();
        $response->assertSee($pf->nama);
        $response->assertSee('name="file_' . $pf->id . '"', false);
    }

    public function test_peserta_yang_sudah_isi_penawaran_tender_lain_tetap_bisa_isi_tender_baru()
    {
        // Peserta 1 sudah punya penawaran_peserta di tender 2 (dari seeder).
        // Aturan yang benar: peserta boleh mengikuti banyak tender.
        $user = User::find(2);
        $penawaran = penawaran::where('tender_id', 5)->firstOrFail();

        $payload = ['id' => 5, 'penawaran' => 1445000000];
        foreach ($penawaran->penawaran_file as $pf) {
            $payload['file_' . $pf->id] = UploadedFile::fake()->create('penawaran.pdf', 100, 'application/pdf');
        }

        $response = $this->actingAs($user)->post('/penawaran_peserta', $payload);

        $response->assertStatus(302);
        $this->assertDatabaseHas('penawaran_pesertas', [
            'tender_id' => 5,
            'peserta_id' => 1,
            'penawaran' => '1445000000',
        ]);
        $this->assertDatabaseHas('penawaran_pesertas', ['tender_id' => 2, 'peserta_id' => 1]);
    }

    public function test_submit_penawaran_ulang_di_tender_sama_memperbarui_bukan_duplikat()
    {
        $user = User::find(2);
        $penawaran = penawaran::where('tender_id', 5)->firstOrFail();

        $files = function () use ($penawaran) {
            $out = [];
            foreach ($penawaran->penawaran_file as $pf) {
                $out['file_' . $pf->id] = UploadedFile::fake()->create('penawaran.pdf', 100, 'application/pdf');
            }
            return $out;
        };

        $base = ['id' => 5];
        $this->actingAs($user)->post('/penawaran_peserta', $base + $files() + ['penawaran' => 1445000000]);
        $response = $this->actingAs($user)->post('/penawaran_peserta', $base + $files() + ['penawaran' => 1440000000]);

        $response->assertStatus(302);
        $this->assertSame(1, penawaran_peserta::where('tender_id', 5)->where('peserta_id', 1)->count(), 'Hanya 1 penawaran per (peserta, tender)');
        $this->assertSame('1440000000', penawaran_peserta::where('tender_id', 5)->where('peserta_id', 1)->value('penawaran'));
    }
}