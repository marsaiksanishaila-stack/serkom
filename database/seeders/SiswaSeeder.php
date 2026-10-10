<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = [
            [
                'nisn'          => '0081234567',
                'nama_siswa'    => 'Ahmad Rizky Pratama',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => 2024,
            ],
            [
                'nisn'          => '0087654321',
                'nama_siswa'    => 'Anisa Rahmawati',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => 2024,
            ],
            [
                'nisn'          => '0071122334',
                'nama_siswa'    => 'Bayu Putra Setiawan',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => 2025,
            ],
            [
                'nisn'          => '0075566778',
                'nama_siswa'    => 'Citra Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk'   => 2025,
            ],
            [
                'nisn'          => '0069988776',
                'nama_siswa'    => 'Daffa Fauzan',
                'jenis_kelamin' => 'Laki-Laki',
                'tahun_masuk'   => 2026,
            ],
        ];

        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }
    }
}