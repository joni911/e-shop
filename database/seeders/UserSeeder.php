<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin/Panitia Tender
        $admin = User::create([
            'name' => 'Admin Panitia PBJ',
            'email' => 'admin@pbj.go.id',
            'password' => Hash::make('password'),
            'hak_akses' => 'admin',
        ]);
        $admin->forceFill(['email_verified_at' => now()])->save();

        // Peserta 1 - PT Maju Jaya
        $p1 = User::create([
            'name' => 'PT Maju Jaya Konstruksi',
            'email' => 'peserta1@maju-jaya.co.id',
            'password' => Hash::make('password'),
            'hak_akses' => 'peserta',
        ]);
        $p1->forceFill(['email_verified_at' => now()])->save();

        // Peserta 2 - PT Sejahtera Abadi
        $p2 = User::create([
            'name' => 'PT Sejahtera Abadi',
            'email' => 'peserta2@sejahtera.co.id',
            'password' => Hash::make('password'),
            'hak_akses' => 'peserta',
        ]);
        $p2->forceFill(['email_verified_at' => now()])->save();

        // Peserta 3 - PT Bangun Nusantara
        $p3 = User::create([
            'name' => 'PT Bangun Nusantara',
            'email' => 'peserta3@bangun-nusantara.co.id',
            'password' => Hash::make('password'),
            'hak_akses' => 'peserta',
        ]);
        $p3->forceFill(['email_verified_at' => now()])->save();

        // Peserta 4 - PT Mitra Sejati
        $p4 = User::create([
            'name' => 'PT Mitra Sejati',
            'email' => 'peserta4@mitra-sejati.co.id',
            'password' => Hash::make('password'),
            'hak_akses' => 'peserta',
        ]);
        $p4->forceFill(['email_verified_at' => now()])->save();
    }
}
