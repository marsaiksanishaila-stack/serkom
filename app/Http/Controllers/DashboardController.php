<?php

namespace App\Http\Controllers;

// Import model-model yang dibutuhkan untuk mengambil ringkasan data di dashboard
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Prestasi;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. HITUNG HITUNGAN KARTU STATISTIK (WIDGET STATS)
        
        // Hitung total keseluruhan siswa
        $totalSiswa = Siswa::count();

        // Hitung total siswa laki-laki
        $totalLaki = Siswa::where('jenis_kelamin', 'Laki-Laki')->count();

        // Hitung total siswa perempuan
        $totalPerempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();

        // Hitung total guru
        $totalGuru = Guru::count();

        // Hitung total ekstrakurikuler yang ada
        $totalEskel = Ekstrakurikuler::count();


        // 2. AMBIL RINGKASAN DATA TERBARU / TERPOPULER
        
        // Ambil 5 data siswa yang paling baru terdaftar/ditambahkan
        $siswaTerbaru = Siswa::orderBy('id_siswa', 'desc')
            ->take(5)
            ->get();

        // Ambil 3 berita paling baru berdasarkan tanggal rilis
        $beritas = Berita::latest('tanggal')
            ->take(3)
            ->get();

        // Ambil 3 pengumuman terbaru yang statusnya sudah 'Publish' (terbit)
        $pengumumans = Pengumuman::where('status', 'Publish')
            ->latest('tanggal')
            ->take(3)
            ->get();

        // Ambil 3 prestasi terbaru berdasarkan tahun ajaran
        $prestasis = Prestasi::latest('tahun_ajaran')
            ->take(3)
            ->get();

        // Ambil 3 ekstrakurikuler yang paling baru dibuat
        $ekstrakurikulers = Ekstrakurikuler::latest('id_ekskul')
            ->take(3)
            ->get();


        // 3. TAMPILKAN HALAMAN DASHBOARD & SEND SEMUA DATANYA
        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalLaki',
            'totalPerempuan',
            'totalGuru',
            'totalEskel',
            'siswaTerbaru',
            'beritas',
            'pengumumans',
            'prestasis',
            'ekstrakurikulers'
        ));
    }
}