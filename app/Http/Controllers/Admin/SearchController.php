<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $keyword = trim($request->get('q', ''));

        $results = collect();

        if ($keyword !== '') {

            // SISWA
            $siswas = Siswa::where(function ($query) use ($keyword) {
                $query->where('nama_siswa', 'like', '%' . $keyword . '%')
                      ->orWhere('nisn', 'like', '%' . $keyword . '%');
            })->limit(10)->get();

            foreach ($siswas as $item) {
                $results->push([
                    'type' => 'Siswa',
                    'title' => $item->nama_siswa,
                    'description' => 'NISN: ' . $item->nisn,
                    'icon' => 'bi-person-fill',
                    'url' => route('admin.siswa.index'),
                ]);
            }


            // GURU
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


            // BERITA
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


            // GALERI
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


            // EKSTRAKURIKULER
            $ekstrakulers = Ekstrakurikuler::where(
                'nama_ekskul',
                'like',
                '%' . $keyword . '%'
            )->limit(10)->get();

            foreach ($ekstrakulers as $item) {
                $results->push([
                    'type' => 'Ekstrakurikuler',
                    'title' => $item->nama_ekskul,
                    'description' => 'Kegiatan ekstrakurikuler',
                    'icon' => 'bi-trophy-fill',
                    'url' => route('admin.ekstrakurikuler'),
                ]);
            }


            // PENGUMUMAN
            $pengumumans = Pengumuman::where(
                'judul',
                'like',
                '%' . $keyword . '%'
            )->limit(10)->get();

            foreach ($pengumumans as $item) {
                $results->push([
                    'type' => 'Pengumuman',
                    'title' => $item->judul,
                    'description' => 'Pengumuman sekolah',
                    'icon' => 'bi-megaphone-fill',
                    'url' => route('admin.pengumuman'),
                ]);
            }


            // PRESTASI
            $prestasis = Prestasi::where(
                'nama_prestasi',
                'like',
                '%' . $keyword . '%'
            )->limit(10)->get();

            foreach ($prestasis as $item) {
                $results->push([
                    'type' => 'Prestasi',
                    'title' => $item->nama_prestasi,
                    'description' => 'Prestasi sekolah',
                    'icon' => 'bi-award-fill',
                    'url' => route('admin.prestasi'),
                ]);
            }


            // PROFIL SEKOLAH
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


            // USER - HANYA ADMIN
            if (auth()->user()->role === 'Admin') {

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

        return view('admin.search', compact('keyword', 'results'));
    }
}