<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'nama_sekolah'   => 'SMPN 2 Mangunreja',
            'kepala_sekolah' => 'Evi susanti',
            'foto'           => null, // Bisa diunggah via form admin nantinya
            'logo'           => null, // Bisa diunggah via form admin nantinya
            'npsn'           => '20253034',
            'alamat'         => 'Jl. Baru, desa. sukasukur, kec. mangunreja, kab. tasikmalaya',
            'kontak'         => '02652553013',
            'visi_misi'      => "Visi:\n“Terwujudnya peserta didik yang berkarakter, berakhlak mulia, berprestasi, serta mampu berkembang sesuai dengan tuntutan zaman.”\n\nMisi:\n1. Menyelenggarakan pembelajaran yang aktif, kreatif, inovatif, efektif, dan menyenangkan.\n2. Membentuk peserta didik yang beriman, berakhlak mulia, disiplin, mandiri, dan bertanggung jawab.\n3. Mengembangkan potensi akademik dan nonakademik peserta didik.\n4. Meningkatkan budaya literasi dan kecakapan peserta didik.\n5. Menciptakan lingkungan sekolah yang bersih, sehat, aman, dan nyaman.\n6. Meningkatkan profesionalisme guru dan tenaga kependidikan.\n7. Membangun kerja sama yang baik antara sekolah, orang tua, dan masyarakat.",
            'tahun_berdiri'  => 2008,
            'deskripsi'      => 'SMP Negeri 2 Mangunreja merupakan sekolah menengah pertama negeri yang berlokasi di Kecamatan Mangunreja, Kabupaten Tasikmalaya, Jawa Barat. Sekolah ini berkomitmen memberikan pendidikan yang berkualitas dengan mengembangkan potensi akademik, keterampilan, serta karakter peserta didik. Dengan didukung oleh tenaga pendidik dan kependidikan serta lingkungan sekolah yang nyaman, SMP Negeri 2 Mangunreja terus berupaya menciptakan peserta didik yang berakhlak, berprestasi, mandiri, dan mampu menghadapi perkembangan zaman.',
        ]);
    }
}