<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,          // Dijalankan pertama untuk ketersediaan id_user (foreign key)
            ProfileSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
            BeritaSeeder::class,         // Membutuhkan id_user dari AdminSeeder
            EkstrakurikulerSeeder::class,
            GaleriSeeder::class,
            PengumumanSeeder::class,     // Membutuhkan id_user dari AdminSeeder
            PrestasiSeeder::class,
        ]);
    }
}