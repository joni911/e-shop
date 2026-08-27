<?php

namespace Tests\Feature;

use App\Models\daftar_peserta;
use App\Models\peserta;
use App\Models\tender;
use App\Models\User;
use App\Notifications\NotifikasiDaftarTender;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Menguji ALUR PENDAFTARAN PESERTA sesungguhnya:
 * 1. GET /peserta/create  -> form registrasi profil + berkas (tender default), atau redirect edit jika sudah punya profil
 * 2. POST /peserta (store) -> simpan profil + upload berkas wajib tender default
 * 3. POST /daftar_peserta  -> mendaftarkan profil ke tender spesifik + kirim notifikasi
 * 4. GET /tender_home/{id} -> halaman detail tender (tergantung tahapan status=1/4)
 */
class PendaftaranTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    /** User peserta baru yang belum punya profil */
    private function newPesertaUser(): User
    {
        $user = User::create([
            'name' => 'PT Uji Coba Baru',
            'email' => 'uji-coba@pengadaan.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        // email_verified_at tidak ada di $fillable -> wajib forceFill agar lolos middleware 'verified'
        $user->forceFill(['email_verified_at' => now()])->save();
        return $user;
    }

    /** Payload form registrasi sesuai form.blade.php (field name + upload key = id tender_file) */
    private function payload(User $user, bool $withFiles = true): array
    {
        $tenderDefault = tender::where('default', 1)->firstOrFail();

        $payload = [
            'id' => $tenderDefault->id,
            'izin' => 'NIB',
            'nomor_izin' => '8129998887776',
            'izin_berlaku' => '2050-01-01',
            'instansi_pemberi' => 'Kementerian Perdagangan RI',
            'kualifikasi' => 'Menengah',
            'klasifikasi' => 'Bangunan Gedung',
            'nama_pt' => $user->name,
            'no_akta' => '001',
            'tgl_akta' => '2020-01-01',
            'notaris' => 'Notaris Uji',
            'no_aktab' => '002',
            'tgl_aktab' => '2021-01-01',
            'notaris_b' => 'Notaris Uji B',
            'kswp_npwp' => '123456789012345',
            'kswp_nama' => $user->name,
            'no_hp' => '081234567899',
            'alamat' => 'Jl. Uji Coba No. 1, Jakarta',
            'email' => $user->email,
        ];

        if ($withFiles) {
            foreach ($tenderDefault->tender_file as $tf) {
                $payload['file_' . $tf->id] = UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf');
            }
        }

        return $payload;
    }

    // ---------------------------------------------------------------
    // 1. FUNGSI GET /peserta/create
    // ---------------------------------------------------------------

    public function test_create_menampilkan_form_registrasi_untuk_user_baru()
    {
        $user = $this->newPesertaUser();

        $response = $this->actingAs($user)->get('/peserta/create');

        $response->assertStatus(200);
        $response->assertSee('Pendaftaran Kelengkapan Berkas Peserta');
    }

    public function test_create_redirect_ke_edit_saat_user_sudah_punya_profil()
    {
        $user = User::find(2); // peserta1 dari seeder -> sudah punya peserta id=1

        $response = $this->actingAs($user)->get('/peserta/create');

        $response->assertRedirect(route('peserta.edit', [1]));
    }

    // ---------------------------------------------------------------
    // 2. FUNGSI POST /peserta (store)
    // ---------------------------------------------------------------

    public function test_store_menyimpan_profil_dan_semua_berkas_wajib()
    {
        $user = $this->newPesertaUser();
        $tenderDefault = tender::where('default', 1)->firstOrFail();

        $response = $this->actingAs($user)->post('/peserta', $this->payload($user));

        $peserta = peserta::where('user_id', $user->id)->first();
        $this->assertNotNull($peserta, 'Profil peserta harus tersimpan');
        $this->assertSame($tenderDefault->id, $peserta->tender_id, 'Profil terhubung ke tender default');

        $response->assertRedirect(route('pengalaman.show', $peserta->id));

        // Semua berkas wajib tender default harus ter-record di tender_file_details
        $this->assertSame(
            $tenderDefault->tender_file->count(),
            $peserta->tender_file_detail()->count(),
            'Jumlah berkas terupload harus sama dengan tender_file wajib'
        );
        // Path file mengikuti pola Tender/FILE/{tender_id}/{tender_file_id}/
        foreach ($peserta->tender_file_detail as $d) {
            $this->assertStringStartsWith('Tender/FILE/' . $tenderDefault->id . '/', $d->files);
        }
    }

    public function test_store_gagal_saat_salah_satu_berkas_wajib_tidak_diupload()
    {
        $user = $this->newPesertaUser();

        $payload = $this->payload($user);

        // Hapus salah satu berkas wajib dari payload
        $tenderDefault = tender::where('default', 1)->firstOrFail();
        $requiredId = $tenderDefault->tender_file->first()->id;
        unset($payload['file_' . $requiredId]);

        $response = $this->actingAs($user)
            ->from('/peserta/create')
            ->post('/peserta', $payload);

        $response->assertRedirect('/peserta/create');
        $response->assertSessionHasErrors('msg');
        $this->assertDatabaseMissing('pesertas', ['user_id' => $user->id]);
    }

    public function test_store_menolak_saat_field_wajib_kosong()
    {
        $user = $this->newPesertaUser();

        $payload = $this->payload($user);
        $payload['nama_pt'] = '';

        $response = $this->actingAs($user)->post('/peserta', $payload);

        $response->assertSessionHasErrors('nama_pt');
        $this->assertDatabaseMissing('pesertas', ['user_id' => $user->id]);
    }

    // ---------------------------------------------------------------
    // 3. FUNGSI POST /daftar_peserta (daftar ke tender spesifik)
    // ---------------------------------------------------------------

    public function test_user_dapat_mendaftarkan_profil_ke_tender_lain()
    {
        Notification::fake();
        $user = User::find(2);      // peserta1
        $profil = peserta::find(1); // profil milik user 2
        $target = tender::where('default', 0)->where('id', '!=', 2)->firstOrFail(); // tender selain T2 (P1 sudah terdaftar di T2)

        $response = $this->actingAs($user)->post('/daftar_peserta', [
            'id' => $profil->id,
            'tender_id' => $target->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('daftar_pesertas', [
            'user_id' => $user->id,
            'peserta_id' => $profil->id,
            'tender_id' => $target->id,
        ]);
        Notification::assertSentTo($user, NotifikasiDaftarTender::class);
    }

    // ---------------------------------------------------------------
    // 4. FUNGSI GET /tender_home/{id} (detail tender + tahapan status)
    // ---------------------------------------------------------------

    public function test_tender_home_show_merender_tender_publish_dengan_tahapan_status()
    {
        $user = User::find(2);

        $response = $this->actingAs($user)->get('/tender_home/2');

        $response->assertStatus(200);
        $response->assertSee('Pembangunan Gedung Perkantoran 5 Lantai');
    }

    public function test_tender_home_show_merender_tender_default_dengan_upload_window()
    {
        $user = User::find(2);

        $response = $this->actingAs($user)->get('/tender_home/1');

        $response->assertStatus(200);
        $response->assertSee('Registrasi Peserta Default');
    }

    // ---------------------------------------------------------------
    // 5. FUNGSI GET /penawaran_file/{id} (halaman upload penawaran)
    // ---------------------------------------------------------------

    public function test_penawaran_file_show_menampilkan_halaman_saat_belum_ada_penawaran()
    {
        // Tender 1 belum punya data penawaran ($data null) -> harus tetap 200,
        // bukan TypeError number_format dari directive @currency (regresi bug).
        $user = User::find(2);

        $response = $this->actingAs($user)->get('/penawaran_file/1');

        $response->assertStatus(200);
    }

    public function test_penawaran_file_show_menampilkan_halaman_dengan_penawaran_string()
    {
        // Tender 2 punya penawaran & penawaran_peserta; value hps/penawaran berupa string
        // sehingga number_format harus tetap menerimanya (cast float).
        $user = User::find(2);

        $response = $this->actingAs($user)->get('/penawaran_file/2');

        $response->assertStatus(200);
    }
}