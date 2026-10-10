<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Crypt;

class LandingController extends Controller
{
    // HALAMAN UTAMA / BERANDA
    public function index()
    {
        // Data profil sekolah
        $profile = Profile::first();

        $namaSekolah = $profile->nama_sekolah ?? 'SMK YPC Tasikmalaya';
        $npsn = $profile->npsn ?? '-';
        $kepalaSekolah = $profile->kepala_sekolah ?? '-';
        $alamat = $profile->alamat ?? '-';
        $kontak = $profile->kontak ?? '-';
        $heroImage = $profile->foto ?? null;

        // STATISTIK SISWA
        $jumlahSiswa = Siswa::count();

        // STATISTIK DAN DATA GURU
        $jumlahGuru = Guru::count();

        $gurus = Guru::orderBy('id_guru', 'desc')
            ->take(5)
            ->get();

        foreach ($gurus as $guru) {
            $guru->encrypted_id = Crypt::encrypt($guru->id_guru);
        }

        // STATISTIK DAN DATA EKSTRAKURIKULER
        $jumlahEkskul = Ekstrakurikuler::count();

        $ekstrakurikulers = Ekstrakurikuler::orderBy('id_ekskul', 'desc')
            ->take(3)
            ->get();

        foreach ($ekstrakurikulers as $ekstrakurikuler) {
            $ekstrakurikuler->encrypted_id = Crypt::encrypt(
                $ekstrakurikuler->id_ekskul
            );
        }

        // STATISTIK JUMLAH PRESTASI
        $jumlahPrestasi = Prestasi::count();

        // DATA BERITA
        $beritas = Berita::latest()
            ->take(3)
            ->get();

        foreach ($beritas as $berita) {
            $berita->encrypted_id = Crypt::encrypt(
                $berita->id_berita
            );
        }

        // DATA GALERI
        $galeris = Galeri::latest('tanggal')
            ->take(5)
            ->get();

        foreach ($galeris as $galeri) {
            $galeri->encrypted_id = Crypt::encrypt(
                $galeri->id_galeri
            );
        }

        // DATA PENGUMUMAN
        $pengumumans = Pengumuman::latest('tanggal')
            ->take(3)
            ->get();

        foreach ($pengumumans as $pengumuman) {
            $pengumuman->encrypted_id = Crypt::encrypt(
                $pengumuman->id_pengumuman
            );
        }

        // DATA PRESTASI
        $prestasis = Prestasi::orderBy('tahun_ajaran', 'desc')
            ->take(5)
            ->get();

        foreach ($prestasis as $prestasi) {
            $prestasi->encrypted_id = Crypt::encrypt(
                $prestasi->id_prestasi
            );
        }

        // KIRIM DATA KE LANDING PAGE
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
            'jumlahPrestasi',
            'ekstrakurikulers',
            'beritas',
            'galeris',
            'pengumumans',
            'prestasis'
        ));
    }

    // HALAMAN TENTANG SEKOLAH
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

        // Memisahkan teks visi dan misi
        if ($profile && $profile->visi_misi) {
            $visiMisi = $profile->visi_misi;

            if (preg_match(
                '/Visi\s*:?(.*?)(?=Misi\s*:|$)/is',
                $visiMisi,
                $visiMatch
            )) {
                $visi = trim($visiMatch[1]);
            }

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

    // HALAMAN KONTAK SEKOLAH
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
