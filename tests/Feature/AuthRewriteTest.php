<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F1 — Auth Rewrite: verifikasi halaman auth (login/register/verify/password)
 * render 200 + field data lama dipertahankan (data tidak berkurang).
 */
class AuthRewriteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function verifiedUser(): User
    {
        $u = User::create([
            'name' => 'User Auth',
            'email' => 'auth-uji@pbj.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'peserta',
        ]);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    /** Halaman login render + field data lengkap + marker shell */
    public function test_login_page_renders_semua_field(): void
    {
        $resp = $this->get('/login');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('name="email"', $html);
        $this->assertStringContainsString('name="password"', $html);
        $this->assertStringContainsString('name="remember"', $html);
        $this->assertStringContainsString('Lupa password', $html);
        $this->assertStringContainsString('Daftar sekarang', $html);
    }

    /** Halaman register render + field data lengkap */
    public function test_register_page_renders_semua_field(): void
    {
        $resp = $this->get('/register');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('name="name"', $html);
        $this->assertStringContainsString('name="email"', $html);
        $this->assertStringContainsString('name="password"', $html);
        $this->assertStringContainsString('name="password_confirmation"', $html);
        $this->assertStringContainsString('Login', $html);
    }

    /** Login POST yang gagal → kembali ke login + error dipertahankan */
    public function test_login_gagal_mempertahankan_error(): void
    {
        $resp = $this->from('/login')->post('/login', [
            'email' => 'salah@email.com',
            'password' => 'wrongpass',
        ]);
        $resp->assertRedirect('/login');
        $this->assertTrue(session()->has('errors'));
    }

    /** Verify page (user BELUM verified mampukan akses) */
    public function test_verify_page_renders(): void
    {
        $u = User::create([
            'name' => 'Belum Verified',
            'email' => 'belum-verify@pbj.test',
            'password' => bcrypt('password'),
            'hak_akses' => 'user',
        ]);
        // TIDAK forceFill email_verified_at -> tetap belum verified

        $resp = $this->actingAs($u)->get('/email/verify');
        $resp->assertOk();
        $html = $resp->getContent();
        $this->assertStringContainsString('/email/resend', $html); // route verification.resend → action
        $this->assertStringContainsString('ui-shell', $html);
    }

    /** Password request (email) page render */
    public function test_password_email_page_renders(): void
    {
        $resp = $this->get('/password/reset');
        $resp->assertOk();
        $this->assertStringContainsString('name="email"', $resp->getContent());
    }
}
