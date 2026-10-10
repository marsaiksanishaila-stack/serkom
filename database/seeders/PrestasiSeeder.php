<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $prestasis = [
            [
                'nama_prestasi' => 'Juara 1 Lomba Paskibra Tingkat Kabupaten',
                'slug'          => 'juara-1-lomba-paskibra-tingkat-kabupaten',
                'deskripsi'     => 'Tim Paskibra SMPN 2 Mangunreja berhasil meraih gelar Juara Utama dalam Kompetisi Ketangkasan Baris Berbaris tingkat Kabupaten Tasikmalaya.',
                'foto'          => null,
                'tahun_ajaran'  => '2025',
            ],
            [
                'nama_prestasi' => 'Juara 2 Olimpiade Sains Nasional (OSN) Matematika',
                'slug'          => 'juara-2-olimpiade-sains-nasional-osn-matematika',
                'deskripsi'     => 'Perwakilan siswa SMPN 2 Mangunreja meraih peringkat kedua dalam ajang OSN bidang Matematika sub-rayon Singaparna.',
                'foto'          => null,
                'tahun_ajaran'  => '2025',
            ],
            [
                'nama_prestasi' => 'Juara 3 Turnamen Bola Voli Antar SMP',
                'slug'          => 'juara-3-turnamen-bola-voli-antar-smp',
                'deskripsi'     => 'Tim Bola Voli putra berhasil menyabet piala Juara 3 pada kejuaraan olahraga pelajar se-Kabupaten Tasikmalaya.',
                'foto'          => null,
                'tahun_ajaran'  => '2024',
            ],
            [
                'nama_prestasi' => 'Juara 1 Lomba Seni Tari Tradisional',
                'slug'          => 'juara-1-lomba-seni-tari-tradisional',
                'deskripsi'     => 'Grup Seni Tari SMPN 2 Mangunreja meraih penghargaan penampilan terbaik dalam Pekan Seni Budaya Daerah.',
                'foto'          => null,
                'tahun_ajaran'  => '2024',
            ],
        ];

        foreach ($prestasis as $prestasi) {
            Prestasi::create($prestasi);
        }
    }
}