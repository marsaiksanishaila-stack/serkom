<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\User;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID user pertama (Admin) untuk foreign key id_user
        $user = User::first();

        if ($user) {
            $beritas = [
                [
                    'judul'   => 'Kegiatan Upacara Bendera Hari Senin Berjalan Khidmat',
                    'slug'    => 'kegiatan-upacara-bendera-hari-senin-berjalan-khidmat',
                    'isi'     => 'Seluruh siswa dan guru SMPN 2 Mangunreja mengikuti kegiatan upacara bendera hari Senin dengan penuh khidmat. Kepala sekolah bertindak sebagai pembina upacara dan memberikan pesan pentingnya kedisiplinan.',
                    'tanggal' => '2026-10-05',
                    'foto'    => null,
                    'status'  => 'Public',
                    'id_user' => $user->id_user,
                ],
                [
                    'judul'   => 'Pelaksanaan Asesmen Nasional Berbasis Komputer (ANBK)',
                    'slug'    => 'pelaksanaan-asesmen-nasional-berbasis-komputer-anbk',
                    'isi'     => 'SMPN 2 Mangunreja sukses menyelenggarakan ANBK. Kegiatan ini diikuti oleh siswa kelas 8 sebagai bagian dari pemetaan mutu pendidikan nasional.',
                    'tanggal' => '2026-09-20',
                    'foto'    => null,
                    'status'  => 'Public',
                    'id_user' => $user->id_user,
                ],
                [
                    'judul'   => 'Persiapan Lomba Paskibra Tingkat Kabupaten',
                    'slug'    => 'persiapan-lomba-paskibra-tingkat-kabupaten',
                    'isi'     => 'Tim Paskibra sekolah sedang intensif melakukan latihan harian untuk persiapan mengikuti kompetisi Paskibra tingkat Kabupaten Tasikmalaya.',
                    'tanggal' => '2026-10-01',
                    'foto'    => null,
                    'status'  => 'Draft',
                    'id_user' => $user->id_user,
                ],
            ];

            foreach ($beritas as $berita) {
                Berita::create($berita);
            }
        }
    }
}