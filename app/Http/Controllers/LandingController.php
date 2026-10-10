<?php

namespace App\Http\Controllers;

// Import semua model yang dibutuhkan untuk ditampilkan di halaman depan web
use App\Models\Profile;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Crypt; // Untuk enkripsi ID di URL

class LandingController extends Controller
{
    // --- HALAMAN UTAMA / BERANDA (LANDING PAGE) ---
    public function index()
    {
        // Ambil data profil sekolah dari database
        $profile = Profile::first();

        // Siapkan variabel informasi sekolah (kalau di database kosong, pakai nilai bawaan)
        $namaSekolah = $profile->nama_sekolah ?? 'SMK YPC Tasikmalaya';
        $npsn = $profile->npsn ?? '-';
        $kepalaSekolah = $profile->kepala_sekolah ?? '-';
        $alamat = $profile->alamat ?? '-';
        $kontak = $profile->kontak ?? '-';
        $heroImage = $profile->foto ?? null;

        // --- STATISTIK & PREVIEW DATA UNTUK BERANDA ---

        // 1. Total Siswa
        $jumlahSiswa = Siswa::count();

        // 2. Data Guru
        $jumlahGuru = Guru::count();
        $gurus = Guru::orderBy('id_guru', 'desc')
            ->take(5) // Ambil 5 guru terbaru
            ->get();

        // Enkripsi ID guru untuk keamanan link
        foreach ($gurus as $guru) {
            $guru->encrypted_id = Crypt::encrypt(
                $guru->id_guru
            );
        }

        // 3. Data Ekstrakurikuler
        $jumlahEkskul = Ekstrakurikuler::count();
        $ekstrakurikulers = Ekstrakurikuler::orderBy('id_ekskul', 'desc')
            ->take(3) // Ambil 3 ekskul terbaru
            ->get();

        // Enkripsi ID ekskul untuk keamanan link
        foreach ($ekstrakurikulers as $ekstrakurikuler) {
            $ekstrakurikuler->encrypted_id = Crypt::encrypt(
                $ekstrakurikuler->id_ekskul
            );
        }

        // 4. Data Berita (3 Berita Terbaru)
        $beritas = Berita::latest()
            ->take(3)
            ->get();

        foreach ($beritas as $berita) {
            $berita->encrypted_id = Crypt::encrypt(
                $berita->id_berita
            );
        }

        // 5. Data Galeri (5 Foto/Video Terbaru)
        $galeris = Galeri::latest('tanggal')
            ->take(5)
            ->get();

        foreach ($galeris as $galeri) {
            $galeri->encrypted_id = Crypt::encrypt(
                $galeri->id_galeri
            );
        }

        // 6. Data Pengumuman (3 Pengumuman Terbaru)
        $pengumumans = Pengumuman::latest('tanggal')
            ->take(3)
            ->get();

        foreach ($pengumumans as $pengumuman) {
            $pengumuman->encrypted_id = Crypt::encrypt(
                $pengumuman->id_pengumuman
            );
        }

        // 7. Data Prestasi (5 Prestasi Terbaru)
        $prestasis = Prestasi::orderBy('tahun_ajaran', 'desc')
            ->take(5)
            ->get();

        foreach ($prestasis as $prestasi) {
            $prestasi->encrypted_id = Crypt::encrypt(
                $prestasi->id_prestasi
            );
        }

        // Kirim semua data ringkasan ke tampilan landing page
        return view('landing', compact(
            'profile',
            'namaSekolah',
            'npsn',
            'kepalaSekolah',
            'alamat',
            'kontak',
            'heroImage',
            'jumlahSiswa',
            'jumlahGuru',
            'gurus',
            'jumlahEkskul',
            'ekstrakurikulers',
            'beritas',
            'galeris',
            'pengumumans',
            'prestasis'
        ));
    }

    // --- HALAMAN "TENTANG SEKOLAH" ---
    public function tentang()
    {
        $profile = Profile::first();

        $namaSekolah = $profile->nama_sekolah ?? 'SMK YPC Tasikmalaya';
        $npsn = $profile->npsn ?? '-';
        $kepalaSekolah = $profile->kepala_sekolah ?? '-';
        $alamat = $profile->alamat ?? '-';
        $kontak = $profile->kontak ?? '-';

        $visi = '';
        $misi = '';

        // Trik memisahkan teks Visi dan Misi dari 1 kolom database secara otomatis (pakai Regex)
        if ($profile && $profile->visi_misi) {
            $visiMisi = $profile->visi_misi;

            // Cari teks setelah kata "Visi:" sampai sebelum kata "Misi:"
            if (preg_match(
                '/Visi\s*:?(.*?)(?=Misi\s*:|$)/is',
                $visiMisi,
                $visiMatch
            )) {
                $visi = trim($visiMatch[1]);
            }

            // Cari teks setelah kata "Misi:" sampai akhir kalimat
            if (preg_match(
                '/Misi\s*:?(.*)$/is',
                $visiMisi,
                $misiMatch
            )) {
                $misi = trim($misiMatch[1]);
            }
        }

        return view('landing.tentang.index', compact(
            'profile',
            'namaSekolah',
            'npsn',
            'kepalaSekolah',
            'alamat',
            'kontak',
            'visi',
            'misi'
        ));
    }

    // --- HALAMAN "KONTAK SEKOLAH" ---
    public function kontak()
    {
        $profile = Profile::first();

        $namaSekolah = $profile->nama_sekolah ?? 'SMK YPC Tasikmalaya';
        $npsn = $profile->npsn ?? '-';
        $alamat = $profile->alamat ?? '-';
        $kontak = $profile->kontak ?? '-';

        return view('kontak.index', compact(
            'profile',
            'namaSekolah',
            'npsn',
            'alamat',
            'kontak'
        ));
    }
}