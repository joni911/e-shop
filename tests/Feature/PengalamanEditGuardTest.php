<?php

namespace Tests\Feature;

use App\Models\daftar_peserta;
use App\Models\pengalaman_tender;
use App\Models\peserta;
use App\Models\tender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

/**
 * Regresi: edit pengalaman mengirim hidden id = id pengalaman (bukan id peserta)
 * sehingga guard "Data peserta tidak valid" memblokir update.
 * Setelah perbaikan, hidden id selalu = id peserta.
 */
class PengalamanEditGuardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_update_pengalaman_tidak_error_data_peserta_tidak_valid(): void
    {
        // Ambil data yang ada di seeder
        $user = User::where('hak_akses', 'peserta')->first();
        $user->forceFill(['email_verified_at' => now()])->save();
        $profil = $user->peserta;
        $this->assertNotNull($profil);

        // Pastikan terdaftar di tender profil
        daftar_peserta::updateOrCreate(
            ['tender_id' => $profil->tender_id, 'peserta_id' => $profil->id],
            ['user_id' => $user->id]
        );

        // Buat record pengalaman milik profil (isi manual — model tanpa $fillable)
        $pengalaman = new pengalaman_tender();
        $pengalaman->peserta_id = $profil->id;
        $pengalaman->tender_id = $profil->tender_id;
        $pengalaman->user_id = $user->id;
        $pengalaman->pekerjaan = 'Proyek Lama';
        $pengalaman->lokasi = 'Denpasar';
        $pengalaman->instansi = 'PUPR';
        $pengalaman->alamat = 'Jl. Uji';
        $pengalaman->no_hp = '08123456789';
        $pengalaman->no_kontrak = '001/PK';
        $pengalaman->tgl_kontrak = '2024-01-01';
        $pengalaman->presentasi = 50;
        $pengalaman->tgl_selesai_kontrak = '2024-06-01';
        $pengalaman->tgl_serah_terima = '2024-07-01';
        $pengalaman->keterangan = 'Selesai';
        $pengalaman->nilai_kontrak = 100000000;
        $pengalaman->file = '';
        $pengalaman->nama_file = 'dokumen';
        $pengalaman->save();

        // Payload mensimulasikan form edit: hidden id = ID PESERTA (bukan id pengalaman)
        $payload = [
            'id' => $profil->id,               // ← setelah perbaikan
            'tender_id' => $profil->tender_id,
            'pekerjaan' => 'Proyek Baru',
            'lokasi' => 'Gianyar',
            'instansi' => 'PUPR',
            'alamat' => 'Jl. Edit',
            'no_hp' => '08123456789',
            'no_kontrak' => '002/PK',
            'tgl_kontrak' => '2024-02-01',
            'presentasi' => 60,
            'tgl_selesai_kontrak' => '2024-07-01',
            'tgl_serah_terima' => '2024-08-01',
            'keterangan' => 'Update',
            'nilai_kontrak' => 120000000,
            'nama_file' => 'dokumen2',
        ];

        $response = $this->actingAs($user)
            ->from('/pengalaman/' . $pengalaman->id . '/edit')
            ->put('/pengalaman/' . $pengalaman->id, $payload);

        $response->assertSessionDoesntHaveErrors('msg');
        $response->assertStatus(302);
        $this->assertSame('Proyek Baru', $pengalaman->fresh()->pekerjaan);
    }
}
