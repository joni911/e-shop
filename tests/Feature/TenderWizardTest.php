<?php

namespace Tests\Feature;

use App\Models\daftar_peserta;
use App\Models\User;
use App\Services\TenderContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

/**
 * Alur Tender Wizard (peserta×tender, konteks session):
 *   hub (peserta.tenders) → pilih tender (peserta.wizard) → set session →
 *   buka halaman pengalaman → simpan dengan tender konteks.
 */
class TenderWizardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    private function profilUser(): \App\Models\User
    {
        $user = User::where('hak_akses', 'peserta')->first();
        $user->forceFill(['email_verified_at' => now()])->save();
        return $user;
    }

    public function test_wizard_memakai_konteks_tender_session(): void
    {
        $user = $this->profilUser();
        $profil = $user->peserta;
        $this->assertNotNull($profil);

        daftar_peserta::updateOrCreate(
            ['tender_id' => $profil->tender_id, 'peserta_id' => $profil->id],
            ['user_id' => $user->id]
        );

        // 1) buka hub
        $this->actingAs($user)->get(route('peserta.tenders'))->assertOk();

        // 2) pilih tender → wizard set context session
        $this->actingAs($user)->get(route('peserta.wizard', [$profil->id, $profil->tender_id]))
             ->assertOk()
             ->assertSessionHas(TenderContext::KEY);
        $this->assertEquals($profil->tender_id, TenderContext::tenderId());

        // 3) buka halaman pengalaman yang menscope berdasar konteks
        $this->actingAs($user)->get(route('pengalaman.show', [$profil->id]))->assertOk();
    }

    public function test_tidak_bisa_wizard_tender_yang_belum_didaftar(): void
    {
        $user = $this->profilUser();
        $profil = $user->peserta;
        $this->assertNotNull($profil);

        // tender id yang sengaja tidak terdaftar (pakai 99999)
        $this->actingAs($user)
            ->get(route('peserta.wizard', [$profil->id, 999999]))
            ->assertRedirect(route('peserta.tenders'));

        Session::forget('peserta_ctx');
    }
}
