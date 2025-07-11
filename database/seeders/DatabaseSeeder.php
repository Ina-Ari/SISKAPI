<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            JurusanSeeder::class,
            ProdiSeeder::class,
            KepalaProdiSeeder::class,
            BaakSeeder::class,
            UpapkkSeeder::class,
            JenisKegiatanSeeder::class,
            TingkatKegiatanSeeder::class,
            PosisiSeeder::class,
            PoinSeeder::class,
        ]);
    }
}
