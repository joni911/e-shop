<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * MENGUJI PEMISAHAN HAK AKSES (users.hak_akses):
 * - Default hak akses saat register publik = 'user'
 * - Admin ('admin') boleh akses halaman admin (tender_admin, master, penilaian)
 * - Peserta ('peserta') & user hasil register ('user') DILARANG akses halaman admin (403)
 * - Semua user login boleh akses halaman user (tender_home, daftar_peserta)
 */
class HakAksesTest extends TestCase
{
    use RefreshDatabase;

    /** Buat user dengan hak_akses tertentu (verified agar lolos middleware 'verified') */
    private function makeUser(string $hakAkses, string $email): User
    {
        $user = User::create([
            'name' => 'User '.$hakAkses,
            'email' => $email,
            'password' => bcrypt('password'),
            'hak_akses' => $hakAkses,
        ]);
        $user->forceFill(['email_verified_at' => now()])->save();
        return $user;
    }

    /** 1. Default hak akses saat registrasi publik harus 'user' */
    public function test_register_default_hak_akses_adalah_user()
    {
        $this->post('/register', [
            'name' => 'PT Baru Terdaftar',
            'email' => 'baru@register.test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'baru@register.test',
            'hak_akses' => 'user',
        ]);
    }

    /** 2. Admin boleh buka halaman admin */
    public function test_admin_bisa_akses_halaman_admin()
    {
        $admin = $this->makeUser('admin', 'admin-uji@pbj.test');

        $this->actingAs($admin)
            ->get('/tender_admin')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/katagori')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertOk();
    }

    /** 3. Peserta TIDAK boleh buka halaman admin (403) */
    public function test_peserta_dilarang_akses_halaman_admin()
    {
        $peserta = $this->makeUser('peserta', 'peserta-uji@pbj.test');

        $this->actingAs($peserta)
            ->get('/tender_admin')
            ->assertForbidden();

        $this->actingAs($peserta)
            ->get('/katagori')
            ->assertForbidden();

        $this->actingAs($peserta)
            ->get('/dashboard')
            ->assertForbidden();
    }

    /** 4. User hasil register publik ('user') juga dilarang akses halaman admin */
    public function test_user_register_dilarang_akses_halaman_admin()
    {
        $user = $this->makeUser('user', 'user-uji@pbj.test');

        $this->actingAs($user)
            ->get('/tender_admin')
            ->assertForbidden();

        $this->actingAs($user)
            ->get('/status_tender')
            ->assertForbidden();
    }

    /** 5. Peserta tetap boleh akses halaman user (tender_home, daftar_peserta) */
    public function test_peserta_boleh_akses_halaman_user()
    {
        $peserta = $this->makeUser('peserta', 'peserta-uji2@pbj.test');

        $this->actingAs($peserta)
            ->get('/tender_home')
            ->assertOk();

        $this->actingAs($peserta)
            ->get('/daftar_peserta')
            ->assertOk();
    }

    /** 6. Belum login -> redirect ke login (bukan 403) */
    public function test_belum_login_dialihkan_ke_login()
    {
        $this->get('/tender_admin')
            ->assertRedirect('/login');
    }
}
