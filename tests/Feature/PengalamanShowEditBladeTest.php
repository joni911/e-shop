<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Smoke: halaman show.edit pengalaman dipecah dari create.blade.php
 * menjadi show.blade.php (Tambah) & edit.blade.php (Edit).
 * Pastikan keduanya bisa di-render tanpa error oleh PengalamanTenderController.
 */
class PengalamanShowEditBladeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_show_dan_edit_blade_ter_render(): void
    {
        $user = User::where('hak_akses', 'peserta')->first();
        $user->forceFill(['email_verified_at' => now()])->save();
        $profil = $user->peserta;
        $this->assertNotNull($profil);

        // Tidak ada data pengalaman untuk peserta pertama di seeder -> hanya cek render edit via insert manual
        $pengalaman = new \App\Models\pengalaman_tender();
        $pengalaman->peserta_id = $profil->id;
        $pengalaman->tender_id = $profil->tender_id;
        $pengalaman->user_id = $user->id;
        $pengalaman->pekerjaan = 'Proyek Test';
        $pengalaman->lokasi = 'Denpasar';
        $pengalaman->instansi = 'PUPR';
        $pengalaman->alamat = '-';
        $pengalaman->no_hp = '08123456789';
        $pengalaman->no_kontrak = '001/PK';
        $pengalaman->tgl_kontrak = '2024-01-01';
        $pengalaman->presentasi = 50;
        $pengalaman->tgl_selesai_kontrak = '2024-06-01';
        $pengalaman->tgl_serah_terima = '2024-07-01';
        $pengalaman->keterangan = 'Selesai';
        $pengalaman->nilai_kontrak = 100000000;
        $pengalaman->file = '';
        $pengalaman->nama_file = 'dok';
        $pengalaman->save();

        // GET /pengalaman/{peserta} -> show.blade.php
        $this->actingAs($user)
            ->get("/pengalaman/{$profil->id}")
            ->assertStatus(200)
            ->assertSee('Tambah Pengalaman')
            ->assertSee('Tender:');

        // GET /pengalaman/{id}/edit -> edit.blade.php
        $this->actingAs($user)
            ->get("/pengalaman/{$pengalaman->id}/edit")
            ->assertStatus(200)
            ->assertSee('Edit Pengalaman');
    }
}
