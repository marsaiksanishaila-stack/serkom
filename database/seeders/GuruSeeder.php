<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = [
            [
                'nama_guru' => 'Evi Susanti, S.Pd.',
                'nip'       => '19750101200001',
                'mapel'     => 'Bahasa Indonesia',
                'foto'      => 'assets/images/111.jpg',
            ],
            [
                'nama_guru' => 'Ahmad Subagja, S.Pd.',
                'nip'       => '19820315200801',
                'mapel'     => 'Matematika',
                'foto'      => 'assets/images/grl.jpg',
            ],
            [
                'nama_guru' => 'Siti Nurhaliza, M.Pd.',
                'nip'       => '19880720201202',
                'mapel'     => 'Bahasa Inggris',
                'foto'      => 'assets/images/OIP.jpg',
            ],
            [
                'nama_guru' => 'Budi Santoso, S.T.',
                'nip'       => '19901105201503',
                'mapel'     => 'IPA',
                'foto'      => 'assets/images/images (6).jpg',
            ],
            [
                'nama_guru' => 'Dede Kurniawan, S.Pd.',
                'nip'       => '19930412201901',
                'mapel'     => 'PJOK',
                'foto'      => 'assets/images/L.jpg',
            ],
        ];

        foreach ($gurus as $guru) {
            Guru::create($guru);
        }
    }
}