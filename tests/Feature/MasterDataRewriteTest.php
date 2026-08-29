<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F5 — Master data & e-shop (Barang): rewrite index/create/edit ke layout admin + komponen.
 * Verifikasi render 200 + shell orange + form field (Q2).
 */
class MasterDataRewriteTest extends TestCase
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
            ?? User::create(['name' => 'Admin M', 'email' => 'admin-m@pbj.test', 'password' => bcrypt('password'), 'hak_akses' => 'admin']);
        $u->forceFill(['email_verified_at' => now()])->save();
        return $u;
    }

    private function assertShell(string $html): void
    {
        $this->assertStringContainsString('ui-shell', $html);
        $this->assertStringNotContainsString('adminlte::', $html);
    }

    public function test_jenis_kontrak_index_create_edit_render(): void
    {
        $a = $this->admin();
        $this->assertShell($this->actingAs($a)->get('/jenis_kontrak')->getContent());
        $this->assertShell($this->actingAs($a)->get('/jenis_kontrak/create')->getContent());
        $this->assertStringContainsString('name="nama"', $this->actingAs($a)->get('/jenis_kontrak/create')->getContent());

        $row = \App\Models\jenis_kontrak::first();
        $edit = $this->actingAs($a)->get('/jenis_kontrak/' . $row->id . '/edit');
        $edit->assertOk();
        $this->assertStringContainsString('value="' . $row->nama . '"', $edit->getContent());
    }

    public function test_jenis_pengadaan_index_create_render(): void
    {
        $a = $this->admin();
        $this->assertShell($this->actingAs($a)->get('/jenis_pengadaan')->getContent());
        $this->assertShell($this->actingAs($a)->get('/jenis_pengadaan/create')->getContent());
    }

    public function test_metode_pengadaan_index_create_render(): void
    {
        $a = $this->admin();
        $this->assertShell($this->actingAs($a)->get('/metode_pengadaan')->getContent());
        $this->assertShell($this->actingAs($a)->get('/metode_pengadaan/create')->getContent());
    }

    public function test_status_tender_render_dan_fix_route_update(): void
    {
        $a = $this->admin();
        $this->assertShell($this->actingAs($a)->get('/status_tender')->getContent());
        $this->assertShell($this->actingAs($a)->get('/status_tender/create')->getContent());

        $row = \App\Models\status_tender::first();
        $edit = $this->actingAs($a)->get('/status_tender/' . $row->id . '/edit');
        $edit->assertOk();
        // Regression: form lama pakai route status_tender_admin.update (tidak terdaftar → 404 di submit)
        $html = $edit->getContent();
        $this->assertStringNotContainsString('status_tender_admin', $html);
        $this->assertStringContainsString('status_tender/' . $row->id . '"', $html);
    }

    public function test_katagori_index_create_dan_store(): void
    {
        $a = $this->admin();
        $this->assertShell($this->actingAs($a)->get('/katagori')->getContent());
        $create = $this->actingAs($a)->get('/katagori/create');
        $create->assertOk();
        $this->assertStringContainsString('name="keterangan"', $create->getContent());

        $resp = $this->actingAs($a)->post('/katagori', ['nama' => 'Katagori Tes F5', 'keterangan' => 'Ket tes']);
        $resp->assertRedirect(route('katagori.index'));
        $this->assertDatabaseHas('katagori_barangs', ['nama' => 'Katagori Tes F5']);
    }

    public function test_barang_crud_render(): void
    {
        $kat = \App\Models\katagori_barang::create(['nama' => 'Katagori Barang', 'keterangan' => 'ket']);
        $barang = \App\Models\barang::create(['katagori_barang_id' => $kat->id, 'nama' => 'Barang F5 Tes', 'harga' => 50000, 'keterangan' => 'ket', 'deskripsi' => 'desk']);
        \App\Models\inventory_barang::create(['barang_id' => $barang->id, 'jumlah' => 7]);

        $a = $this->admin();
        $this->assertShell($this->actingAs($a)->get('/barang')->getContent());
        $this->assertShell($this->actingAs($a)->get('/barang/create')->getContent());

        $edit = $this->actingAs($a)->get('/barang/' . $barang->id . '/edit');
        $edit->assertOk();
        $this->assertStringContainsString('value="Barang F5 Tes"', $edit->getContent());

        $show = $this->actingAs($a)->get('/barang/' . $barang->id);
        $show->assertOk();
        $this->assertStringContainsString('Barang F5 Tes', $show->getContent());
        $this->assertStringContainsString('Deskripsi', $show->getContent());
    }
}