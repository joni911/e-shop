<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MasterSeeder::class,
            UserSeeder::class,
            TenderSeeder::class,
            PesertaSeeder::class,
            PenilaianSeeder::class,
            TenderTestingSeeder::class,
        ]);
    }
}