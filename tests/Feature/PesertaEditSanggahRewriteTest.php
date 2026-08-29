<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Halaman edit peserta (peserta.edit) & sanggahan (sanggahan.index/show)
 * — rewrite dari AdminLTE ke layout dinamis + komponen.
 */
class PesertaEditSanggahRewriteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function admin(): User
    {
        $u = User::where('hak_akses', 'admin')->first()
            ?? User::create(['name' => 'Admin PE', 'email' => 'admin-pe@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    public function test_peserta_edit_renders_shell_dan_field(): void
    {
        $p = \App\Models\peserta::first();
        $resp = $this->actingAs($this->admin())->get('/peserta/' . $p->id . '/edit');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Edit Peserta', $html);
        $this->assertStringContainsString('name="nama_pt"', $html);
        $this->assertStringContainsString('name="izin"', $html);
        $this->assertStringContainsString('name="no_akta"', $html);
        $this->assertStringContainsString('name="kswp_npwp"', $html);
        $this->assertStringContainsString('name="alamat"', $html);
        $this->assertStringContainsString('/peserta/' . $p->id . '"', $html);
        $this->assertStringNotContainsString('x-adminlte', $html);
    }

    public function test_sanggahan_index_renders_shell(): void
    {
        $resp = $this->actingAs($this->admin())->get('/sanggahan');
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Daftar Pengadaan', $html);
        $this->assertStringContainsString('table-wrap', $html);
    }

    public function test_sanggahan_show_renders_form_atau_data(): void
    {
        $admin = $this->admin();
        // Login sebagai user pemilik peserta yang terdaftar (daftar_peserta)
        $dp = \App\Models\daftar_peserta::first();
        if (! $dp) {
            $this->markTestSkipped('Seeder tidak membuat data daftar peserta');
        }
        $peserta = \App\Models\peserta::find($dp->peserta_id);
        $owner = User::find($peserta->user_id);
        $owner->forceFill(['email_verified_at' => now()])->save();

        $resp = $this->actingAs($owner)->get('/sanggahan/' . $dp->tender_id);
        $resp->assertOk();
        $html = $resp->getContent();

        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringContainsString('Sanggah Banding', $html);
        $this->assertStringNotContainsString('x-adminlte', $html);

        // Admin tanpa kaitan peserta → redirect dengan error
        $resp2 = $this->actingAs($admin)->get('/sanggahan/' . $dp->tender_id);
        $resp2->assertRedirect(route('sanggahan.index'));
    }
}