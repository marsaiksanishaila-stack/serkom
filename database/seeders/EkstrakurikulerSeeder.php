<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekstrakurikuler;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $ekstrakurikulers = [
            [
                'nama_ekskul'    => 'Pramuka',
                'slug'           => 'pramuka',
                'pembina'        => 'Ahmad Subagja, S.Pd.',
                'jadwal_latihan' => 'Jumat, 15:00 - 17:00 WIB',
                'deskripsi'      => 'Ekstrakurikuler wajib untuk melatih kedisiplinan, kemandirian, kepemimpinan, dan kecintaan pada alam.',
                'gambar'         => null,
            ],
            [
                'nama_ekskul'    => 'Paskibra',
                'slug'           => 'paskibra',
                'pembina'        => 'Dede Kurniawan, S.Pd.',
                'jadwal_latihan' => 'Sabtu, 08:00 - 11:00 WIB',
                'deskripsi'      => 'Membentuk karakter siswa yang disiplin, tangguh, serta siap bertugas dalam pengibaran bendera.',
                'gambar'         => null,
            ],
            [
                'nama_ekskul'    => 'PMR (Palang Merah Remaja)',
                'slug'           => 'pmr-palang-merah-remaja',
                'pembina'        => 'Siti Nurhaliza, M.Pd.',
                'jadwal_latihan' => 'Rabu, 15:30 - 17:00 WIB',
                'deskripsi'      => 'Mendidik siswa dalam bidang pertolongan pertama, kepedulian sosial, dan kesehatan remaja.',
                'gambar'         => null,
            ],
            [
                'nama_ekskul'    => 'Bola Voli',
                'slug'           => 'bola-voli',
                'pembina'        => 'Budi Santoso, S.T.',
                'jadwal_latihan' => 'Selasa & Kamis, 15:30 - 17:00 WIB',
                'deskripsi'      => 'Wadah pengembangan bakat dan minat siswa dalam olahraga cabang bola voli.',
                'gambar'         => null,
            ],
            [
                'nama_ekskul'    => 'Seni Musik & Seni Tari',
                'slug'           => 'seni-musik-seni-tari',
                'pembina'        => 'Evi Susanti, S.Pd.',
                'jadwal_latihan' => 'Sabtu, 13:00 - 15:00 WIB',
                'deskripsi'      => 'Pengembangan kreativitas dan seni siswa baik seni musik tradisional maupun tari kreasi.',
                'gambar'         => null,
            ],
        ];

        foreach ($ekstrakurikulers as $ekskul) {
            Ekstrakurikuler::create($ekskul);
        }
    }
}