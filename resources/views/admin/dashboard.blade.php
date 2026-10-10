@extends('layouts.admin')

@section('content')

{{-- Tarik 4 data galeri paling baru berdasarkan tanggal --}}
@php
    $galeriTerbaru = \App\Models\Galeri::latest('tanggal')->take(4)->get();
@endphp

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- Section Header/Judul Halaman --}}
        <div class="page-heading d-flex justify-content-between align-items-center mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3">

                <span class="page-icon fs-3 text-primary">
                    <i class="bi bi-speedometer2"></i>
                </span>

                <div>
                    <p class="eyebrow mb-0 text-muted small fw-semibold">
                        OVERVIEW
                    </p>

                    <h1 class="h3 mb-1 fw-bold">
                        Dashboard Sekolah
                    </h1>

                    <p class="text-muted mb-0">
                        Ringkasan statistik operasional, data siswa, guru, dan agenda sekolah.
                    </p>
                </div>

            </div>

            <!-- Tombol cadangan kalau butuh panggil aksi cepat di header
            <div class="heading-actions">
                <a href="{{ route('admin.siswa.index') }}"
                   class="btn btn-primary btn-sm rounded-3 shadow-sm">
                    <i class="bi bi-person-plus me-1"></i>
                    Kelola Siswa
                </a>
            </div> -->

        </div>


        {{-- Section 1: Kumpulan Card Statistik Utama --}}
        <section class="row g-3 mb-4">
            
            {{-- Card Total Siswa & Breakdown Gender --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted fw-semibold small">
                            Total Siswa
                        </span>
                        <span class="p-2 bg-primary-subtle text-primary rounded-3">
                            <i class="bi bi-people-fill fs-5"></i>
                        </span>
                    </div>

                    {{-- Ambil nilai total, kalau null ganti jadi 0 --}}
                    <h3 class="fw-bold mb-1">
                        {{ $totalSiswa ?? 0 }}
                    </h3>

                    {{-- Jumlah Cowok & Cewek --}}
                    <div class="small text-muted">
                        <span class="text-info fw-semibold">
                            {{ $totalLaki ?? 0 }} L
                        </span>
                        /
                        <span class="text-danger fw-semibold">
                            {{ $totalPerempuan ?? 0 }} P
                        </span>
                    </div>

                </div>
            </div>


            {{-- Card Total Guru --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted fw-semibold small">
                            Tenaga Pengajar
                        </span>
                        <span class="p-2 bg-success-subtle text-success rounded-3">
                            <i class="bi bi-person-badge-fill fs-5"></i>
                        </span>
                    </div>

                    <h3 class="fw-bold mb-1">
                        {{ $totalGuru ?? 0 }}
                    </h3>

                    <div class="small text-muted">
                        Guru & Staf Aktif
                    </div>

                </div>
            </div>


            {{-- Card Total Ekstrakurikuler --}}
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted fw-semibold small">
                            Ekstrakurikuler
                        </span>
                        <span class="p-2 bg-warning-subtle text-warning rounded-3">
                            <i class="bi bi-trophy-fill fs-5"></i>
                        </span>
                    </div>

                    <h3 class="fw-bold mb-1">
                        {{ $totalEskel ?? 0 }}
                    </h3>

                    <div class="small text-muted">
                        Kegiatan Siswa
                    </div>

                </div>
            </div>

        </section>


        {{-- Section 2: Shortcut Menu (Akses Cepat) --}}
        <section class="mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="bi bi-lightning-charge-fill me-2 text-primary"></i>
                            Akses Cepat
                        </h5>
                        <p class="text-muted small mb-0">
                            Akses menu yang sering digunakan
                        </p>
                    </div>
                </div>

                {{-- Grid Tombol Navigasi Cepat --}}
                <div class="row g-2">
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-light border rounded-3 w-100 py-3 text-start">
                            <i class="bi bi-people-fill text-primary me-2"></i>
                            kelola Siswa
                        </a>
                    </div>

                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.guru.index') }}" class="btn btn-light border rounded-3 w-100 py-3 text-start">
                            <i class="bi bi-person-badge-fill text-success me-2"></i>
                            Kelola Guru
                        </a>
                    </div>

                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.berita') }}" class="btn btn-light border rounded-3 w-100 py-3 text-start">
                            <i class="bi bi-newspaper text-info me-2"></i>
                            Kelola Berita
                        </a>
                    </div>

                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.pengumuman') }}" class="btn btn-light border rounded-3 w-100 py-3 text-start">
                            <i class="bi bi-megaphone-fill text-warning me-2"></i>
                            Pengumuman
                        </a>
                    </div>
                </div>
            </div>
        </section>


        {{-- Section 3: Tabel Siswa Baru + Feed Agenda Sekolah --}}
        <section class="row g-3">

            {{-- Kolom Kiri: Tabel 5 Siswa Paling Baru Mendaftar --}}
            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

                    <div class="card-header bg-white p-3 border-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">
                                <i class="bi bi-clock-history me-2 text-primary"></i>
                                Siswa Terbaru Masuk
                            </h5>
                            <p class="text-muted small mb-0">
                                Daftar siswa yang baru didaftarkan
                            </p>
                        </div>
                        <a class="btn btn-outline-secondary btn-sm rounded-3" href="{{ route('admin.siswa.index') }}">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3">NISN</th>
                                    <th class="py-3">Nama Siswa</th>
                                    <th class="py-3">Jenis Kelamin</th>
                                    <th class="py-3">Tahun Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Looping maksimal 5 siswa terbaru --}}
                                @forelse($siswaTerbaru->take(5) as $siswa)
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">
                                            {{ $siswa->nisn }}
                                        </td>
                                        <td class="fw-bold text-dark">
                                            {{ $siswa->nama_siswa }}
                                        </td>
                                        <td>
                                            {{-- Badge beda warna berdasarkan gender --}}
                                            <span class="badge {{ $siswa->jenis_kelamin == 'Laki-Laki' ? 'bg-info-subtle text-info' : 'bg-danger-subtle text-danger' }} px-3 py-2">
                                                {{ $siswa->jenis_kelamin }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                                {{ $siswa->tahun_masuk }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Tampilan kalau tabel siswa masih kosong --}}
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Belum ada data siswa.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


            {{-- Kolom Kanan: Feed Agenda & Event Terbaru --}}
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0 p-3">
                        <h5 class="fw-bold mb-1">
                            <i class="bi bi-calendar-event me-2 text-primary"></i>
                            Agenda Sekolah
                        </h5>
                        <p class="text-muted small mb-0">
                            Informasi dan kegiatan terbaru sekolah
                        </p>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">

                            {{-- List Pengumuman Terbaru (Maks 2) --}}
                            @forelse($pengumumans->take(2) as $pengumuman)
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                                    <span class="badge bg-primary mb-2">Pengumuman</span>
                                    <h6 class="fw-bold mb-1">{{ $pengumuman->judul }}</h6>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d-m-Y') }}
                                    </p>
                                </div>
                            @empty
                            @endforelse

                            {{-- List Berita Terbaru (Maks 2) --}}
                            @forelse($beritas->take(2) as $berita)
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-success">
                                    <span class="badge bg-success mb-2">Berita</span>
                                    <h6 class="fw-bold mb-1">{{ $berita->judul }}</h6>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ \Carbon\Carbon::parse($berita->tanggal)->format('d-m-Y') }}
                                    </p>
                                </div>
                            @empty
                            @endforelse

                            {{-- List Prestasi Terbaru (Maks 2) --}}
                            @forelse($prestasis->take(2) as $prestasi)
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-warning">
                                    <span class="badge bg-warning text-dark mb-2">Prestasi</span>
                                    <h6 class="fw-bold mb-1">{{ $prestasi->nama_prestasi }}</h6>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-trophy me-1"></i>
                                        Tahun {{ $prestasi->tahun_ajaran }}
                                    </p>
                                </div>
                            @empty
                            @endforelse

                            {{-- List Ekskul (Maks 2) --}}
                            @forelse($ekstrakurikulers->take(2) as $ekskul)
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-info">
                                    <span class="badge bg-info mb-2">Ekstrakurikuler</span>
                                    <h6 class="fw-bold mb-1">{{ $ekskul->nama_ekskul }}</h6>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $ekskul->jadwal_latihan }}
                                    </p>
                                </div>
                            @empty
                            @endforelse

                            {{-- Tampilkan kondisi ini kalau SEMUA data agenda kosong melompong --}}
                            @if(
                                $pengumumans->isEmpty() &&
                                $beritas->isEmpty() &&
                                $prestasis->isEmpty() &&
                                $ekstrakurikulers->isEmpty()
                            )
                                <div class="text-center py-4">
                                    <i class="bi bi-calendar-x fs-2 text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">
                                        Belum ada agenda sekolah.
                                    </p>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>

        </section>


        {{-- Section 4: Grid Dokumentasi Galeri Terbaru --}}
        <section class="mt-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-header bg-white border-0 p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="bi bi-images me-2 text-primary"></i>
                            Galeri Terbaru
                        </h5>
                        <p class="text-muted small mb-0">
                            Dokumentasi kegiatan sekolah terbaru
                        </p>
                    </div>
                    <a href="{{ route('admin.galeri') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                        Lihat Semua
                    </a>
                </div>

                <div class="card-body">

                    {{-- Kalau belum ada galeri sama sekali --}}
                    @if($galeriTerbaru->isEmpty())

                        <div class="text-center py-4">
                            <i class="bi bi-images fs-2 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">
                                Belum ada data galeri.
                            </p>
                        </div>

                    @else

                        {{-- Loop data galeri (maks 4 dari PHP block paling atas) --}}
                        <div class="row g-3">
                            @foreach($galeriTerbaru as $galeri)
                                <div class="col-6 col-md-3">
                                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">

                                        {{-- Container preview media --}}
                                        <div style="height: 160px; background: #f8fafc;">
                                            {{-- Cek tipe medianya foto atau video --}}
                                            @if($galeri->kategori == 'Foto')
                                                <img src="{{ asset('storage/' . $galeri->file) }}"
                                                     alt="{{ $galeri->judul }}"
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <video controls style="width: 100%; height: 100%; object-fit: cover;">
                                                    <source src="{{ asset('storage/' . $galeri->file) }}">
                                                </video>
                                            @endif
                                        </div>

                                        {{-- Detail info galeri --}}
                                        <div class="p-3">
                                            <span class="badge {{ $galeri->kategori == 'Foto' ? 'bg-primary-subtle text-primary' : 'bg-danger-subtle text-danger' }} mb-2">
                                                {{ $galeri->kategori }}
                                            </span>

                                            <h6 class="fw-bold mb-1 text-truncate" title="{{ $galeri->judul }}">
                                                {{ $galeri->judul }}
                                            </h6>

                                            <p class="text-muted small mb-0">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d-m-Y') }}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif

                </div>

            </div>
        </section>

    </div>

</main>

@endsection