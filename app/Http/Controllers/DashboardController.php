<?php

namespace App\Http\Controllers;

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
        $totalSiswa = Siswa::count();

        $totalLaki = Siswa::where('jenis_kelamin', 'Laki-Laki')->count();

        $totalPerempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();

        $totalGuru = Guru::count();

        $totalEskel = Ekstrakurikuler::count();

        $siswaTerbaru = Siswa::orderBy('id_siswa', 'desc')
            ->take(5)
            ->get();

        $beritas = Berita::latest('tanggal')
            ->take(3)
            ->get();

        $pengumumans = Pengumuman::where('status', 'Publish')
            ->latest('tanggal')
            ->take(3)
            ->get();

        $prestasis = Prestasi::latest('tahun_ajaran')
            ->take(3)
            ->get();

        $ekstrakurikulers = Ekstrakurikuler::latest('id_ekskul')
            ->take(3)
            ->get();

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
