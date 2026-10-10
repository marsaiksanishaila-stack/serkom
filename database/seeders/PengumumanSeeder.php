<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengumuman;
use App\Models\User;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID user pertama (Admin/Operator) untuk foreign key id_user
        $user = User::first();

        if ($user) {
            $pengumumans = [
                [
                    'judul'   => 'Pelaksanaan Penilaian Tengah Semester (PTS) Ganjil',
                    'isi'     => 'Diberitahukan kepada seluruh siswa SMPN 2 Mangunreja bahwa PTS Ganjil akan dilaksanakan mulai tanggal 12 Oktober 2026. Diharapkan seluruh siswa mempersiapkan diri dengan baik.',
                    'tanggal' => '2026-10-01',
                    'status'  => 'Publish', // Disesuaikan dari Public menjadi Publish
                    'id_user' => $user->id_user,
                ],
                [
                    'judul'   => 'Jadwal Libur Nasional dan Cuti Bersama',
                    'isi'     => 'Sehubungan dengan hari libur nasional, kegiatan KBM di sekolah diliburkan. Kegiatan pembelajaran akan aktif kembali pada hari Senin berikutnya.',
                    'tanggal' => '2026-09-15',
                    'status'  => 'Publish', // Disesuaikan dari Public menjadi Publish
                    'id_user' => $user->id_user,
                ],
                [
                    'judul'   => 'Rapat Evaluasi Pembelajaran Guru dan Staf',
                    'isi'     => 'Pengumuman internal untuk seluruh Bapak/Ibu guru dan staf TU mengenai agenda rapat evaluasi bulanan di ruang rapat utama.',
                    'tanggal' => '2026-10-05',
                    'status'  => 'Draft',
                    'id_user' => $user->id_user,
                ],
            ];

            foreach ($pengumumans as $pengumuman) {
                Pengumuman::create($pengumuman);
            }
        }
    }
}