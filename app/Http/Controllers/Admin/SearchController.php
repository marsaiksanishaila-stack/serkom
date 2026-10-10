<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// Load semua model database yang ingin dicari datanya
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\Profile;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil kata kunci dari inputan 'q' di URL, lalu hapus spasi di awal/akhir kata
        $keyword = trim($request->get('q', ''));

        // Wadah kosong untuk menampung semua hasil pencarian dari berbagai tabel
        $results = collect();

        // 2. Hanya jalankan pencarian jika user memasukkan kata kunci (tidak kosong)
        if ($keyword !== '') {

            // --- CARI DATA SISWA ---
            // Cari siswa yang nama atau NISN-nya mirip kata kunci (maksimal 10 data)
            $siswas = Siswa::where(function ($query) use ($keyword) {
                $query->where('nama_siswa', 'like', '%' . $keyword . '%')
                      ->orWhere('nisn', 'like', '%' . $keyword . '%');
            })->limit(10)->get();

            // Masukkan setiap data siswa yang ketemu ke dalam wadah $results
            foreach ($siswas as $item) {
                $results->push([
                    'type' => 'Siswa',
                    'title' => $item->nama_siswa,
                    'description' => 'NISN: ' . $item->nisn,
                    'icon' => 'bi-person-fill',
                    'url' => route('admin.siswa.index'), // Link menuju halaman siswa
                ]);
            }


            // --- CARI DATA GURU ---
            // Cari guru berdasarkan nama, NIP, atau mata pelajaran
            $gurus = Guru::where(function ($query) use ($keyword) {
                $query->where('nama_guru', 'like', '%' . $keyword . '%')
                      ->orWhere('nip', 'like', '%' . $keyword . '%')
                      ->orWhere('mapel', 'like', '%' . $keyword . '%');
            })->limit(10)->get();

            foreach ($gurus as $item) {
                $results->push([
                    'type' => 'Guru',
                    'title' => $item->nama_guru,
                    'description' => 'Mapel: ' . ($item->mapel ?? '-'),
                    'icon' => 'bi-person-workspace',
                    'url' => route('admin.guru.index'),
                ]);
            }


            // --- CARI BERITA ---
            // Cari berita berdasarkan judulnya
            $beritas = Berita::where('judul', 'like', '%' . $keyword . '%')
                ->limit(10)
                ->get();

            foreach ($beritas as $item) {
                $results->push([
                    'type' => 'Berita',
                    'title' => $item->judul,
                    'description' => 'Berita sekolah',
                    'icon' => 'bi-newspaper',
                    'url' => route('admin.berita'),
                ]);
            }


            // --- CARI GALERI ---
            // Cari foto/album galeri berdasarkan judul
            $galeris = Galeri::where('judul', 'like', '%' . $keyword . '%')
                ->limit(10)
                ->get();

            foreach ($galeris as $item) {
                $results->push([
                    'type' => 'Galeri',
                    'title' => $item->judul,
                    'description' => 'Dokumentasi sekolah',
                    'icon' => 'bi-images',
                    'url' => route('admin.galeri'),
                ]);
            }


            // --- CARI EKSTRAKURIKULER ---
            // Cari ekskul berdasarkan nama ekstrakurikuler
            $ekstrakulers = Ekstrakurikuler::where('nama_ekskul', 'like', '%' . $keyword . '%')
                ->limit(10)
                ->get();

            foreach ($ekstrakulers as $item) {
                $results->push([
                    'type' => 'Ekstrakurikuler',
                    'title' => $item->nama_ekskul,
                    'description' => 'Kegiatan ekstrakurikuler',
                    'icon' => 'bi-trophy-fill',
                    'url' => route('admin.ekstrakurikuler'),
                ]);
            }


            // --- CARI PENGUMUMAN ---
            // Cari pengumuman berdasarkan judul
            $pengumumans = Pengumuman::where('judul', 'like', '%' . $keyword . '%')
                ->limit(10)
                ->get();

            foreach ($pengumumans as $item) {
                $results->push([
                    'type' => 'Pengumuman',
                    'title' => $item->judul,
                    'description' => 'Pengumuman sekolah',
                    'icon' => 'bi-megaphone-fill',
                    'url' => route('admin.pengumuman'),
                ]);
            }


            // --- CARI PRESTASI ---
            // Cari prestasi berdasarkan nama prestasi
            $prestasis = Prestasi::where('nama_prestasi', 'like', '%' . $keyword . '%')
                ->limit(10)
                ->get();

            foreach ($prestasis as $item) {
                $results->push([
                    'type' => 'Prestasi',
                    'title' => $item->nama_prestasi,
                    'description' => 'Prestasi sekolah',
                    'icon' => 'bi-award-fill',
                    'url' => route('admin.prestasi'),
                ]);
            }


            // --- CARI PROFIL SEKOLAH ---
            // Cari info profil sekolah (nama, NPSN, nama kepsek, alamat, atau kontak)
            $profiles = Profile::where(function ($query) use ($keyword) {
                $query->where('nama_sekolah', 'like', '%' . $keyword . '%')
                      ->orWhere('npsn', 'like', '%' . $keyword . '%')
                      ->orWhere('kepala_sekolah', 'like', '%' . $keyword . '%')
                      ->orWhere('alamat', 'like', '%' . $keyword . '%')
                      ->orWhere('kontak', 'like', '%' . $keyword . '%');
            })->limit(10)->get();

            foreach ($profiles as $item) {
                $results->push([
                    'type' => 'Profil Sekolah',
                    'title' => $item->nama_sekolah,
                    'description' => 'Profil sekolah',
                    'icon' => 'bi-building-fill',
                    'url' => route('admin.profilsekolah'),
                ]);
            }


            // --- CARI AKUN USER (KHUSUS ADMIN) ---
            // Fitur ini hanya jalan kalau user yang lagi login punya role 'Admin'
            if (auth()->user()->role === 'Admin') {

                // Cari akun berdasarkan username atau role
                $users = User::where(function ($query) use ($keyword) {
                    $query->where('username', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                })->limit(10)->get();

                foreach ($users as $item) {
                    $results->push([
                        'type' => 'User',
                        'title' => $item->username,
                        'description' => 'Role: ' . $item->role,
                        'icon' => 'bi-person-gear',
                        'url' => route('admin.user.index'),
                    ]);
                }
            }
        }

        // 3. Tampilkan halaman pencarian ('admin.search') dan kirim data kata kunci beserta hasil pencariannya
        return view('admin.search', compact('keyword', 'results'));
    }
}