<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $galeris = [
            [
                'judul'      => 'Upacara Bendera Hari Kemerdekaan',
                'slug'       => 'upacara-bendera-hari-kemerdekaan',
                'keterangan' => 'Pelaksanaan upacara peringatan HUT RI yang diikuti oleh seluruh warga SMPN 2 Mangunreja.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => '2026-08-17',
            ],
            [
                'judul'      => 'Dokumentasi Pentas Seni Sekolah',
                'slug'       => 'dokumentasi-pentas-seni-sekolah',
                'keterangan' => 'Video cuplikan keseruan penampilan seni musik dan tari dari para siswa.',
                'file'       => null,
                'kategori'   => 'Video',
                'tanggal'    => '2026-09-12',
            ],
            [
                'judul'      => 'Lomba Ketangkasan Pramuka',
                'slug'       => 'lomba-ketangkasan-pramuka',
                'keterangan' => 'Kegiatan perkemahan dan perlombaan antar regu Pramuka SMPN 2 Mangunreja.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => '2026-09-25',
            ],
            [
                'judul'      => 'Suasana Pembelajaran di Lab Komputer',
                'slug'       => 'suasana-pembelajaran-di-lab-komputer',
                'keterangan' => 'Siswa kelas 8 sedang mengikuti simulasi asesmen berbasis komputer.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => '2026-10-02',
            ],
        ];

        foreach ($galeris as $galeri) {
            Galeri::create($galeri);
        }
    }
}