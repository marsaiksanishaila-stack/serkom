@php
    $profile = \App\Models\Profile::first();

    $namaSekolah = $profile->nama_sekolah ?? 'SMK YPC Tasikmalaya';
    $npsn = $profile->npsn ?? '-';
    $kepalaSekolah = $profile->kepala_sekolah ?? '-';
    $alamat = $profile->alamat ?? 'Tasikmalaya, Jawa Barat';
    $kontak = $profile->kontak ?? '-';

    $jumlahSiswa = \App\Models\Siswa::count();
    $jumlahGuru = \App\Models\Guru::count();
    $jumlahEkskul = \App\Models\Ekstrakurikuler::count();

    $gurus = \App\Models\Guru::orderBy('id_guru', 'desc')->take(5)->get();

    $beritas = \App\Models\Berita::latest()->take(3)->get();

    $galeris = \App\Models\Galeri::latest('tanggal')->take(5)->get();

    $heroImage = $profile->foto ?? null;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaSekolah }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
    <!-- NAVBAR -->
<nav class="landing-navbar">
    <div class="container">
        <div class="navbar-content">
            <a href="#beranda" class="school-logo">
                @if($profile && $profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="{{ $namaSekolah }}">
                @else
                    <div class="logo-default">
                        <i class="bi bi-building-fill"></i>
                    </div>
                @endif
                <div>
                    <strong>{{ $namaSekolah }}</strong>
                    <span>Tasikmalaya</span>
                </div>
            </a>

            <div class="desktop-menu">
                <a href="#beranda" class="active">Beranda</a>
                <a href="#tentang">Tentang</a>
                <a href="#program">Program</a>
                <a href="#guru">Guru</a>
                <a href="#berita">Berita</a>
                <a href="#galeri">Galeri</a>
                <a href="#kontak">Kontak</a>
                <a href="{{ route('login') }}"
                   class="login-button">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login Admin
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero" id="beranda">
    @if ($heroImage)
        <img src="{{ asset('storage/' . $heroImage) }}"
             alt="{{ $namaSekolah }}"
             class="hero-image">
    @else
        <div class="hero-image hero-placeholder"></div>
    @endif
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-label">
                SEKOLAH MENENGAH PERTAMA
            </div>
            <h1>
                Membangun Generasi
                <span>Unggul dan Berkarakter</span>
            </h1>
            <p>
                {{ $namaSekolah }} berkomitmen memberikan
                pendidikan berkualitas untuk membentuk siswa
                yang berkarakter, berprestasi, kreatif, dan
                siap melanjutkan pendidikan ke jenjang yang lebih tinggi.
            </p>
            <div class="hero-buttons">
                <a href="#tentang"
                   class="btn-main">
                    Kenali Sekolah Kami
                    <i class="bi bi-arrow-right"></i>
                </a>
                <a href="#program"
                   class="btn-outline">
                    Lihat Program
                </a>
            </div>
        </div>
    </div>
</section>

<!-- STATISTIK -->
<section class="stats-wrapper">

    <div class="container">
        <div class="stats-box">
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <strong>{{ $jumlahSiswa }}+</strong>
                    <span>Siswa</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-person-workspace"></i>
                </div>

                <div>
                    <strong>{{ $jumlahGuru }}+</strong>
                    <span>Guru & Staf</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-trophy-fill"></i>
                </div>

                <div>
                    <strong>{{ $jumlahEkskul }}+</strong>
                    <span>Ekstrakurikuler</span>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-award-fill"></i>
                </div>
                <div>
                    <strong>B</strong>
                    <span>Akreditasi</span>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- TENTANG -->
<section class="about-section" id="tentang">
    <div class="container">
        <div class="section-header">
            <span>TENTANG SEKOLAH</span>
            <h2>
                Mengenal {{ $namaSekolah }}
            </h2>
            <p>
                Pendidikan untuk membentuk generasi
                yang kompeten dan berkarakter.
            </p>
        </div>

        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-visual">
                    <div class="about-image-main">
                         @if ($heroImage)
                            <img src="{{ asset('storage/' . $heroImage) }}"
                                 alt="Kegiatan sekolah">
                        @else
                            <div class="about-placeholder">
                                <i class="bi bi-building"></i>
                            </div>
                        @endif
                    </div>
                    <div class="about-badge">
                        <strong>{{ $namaSekolah }}</strong>
                        <span>Tasikmalaya</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-content">
                    <span class="content-label">
                        PROFIL SEKOLAH
                    </span>
                    <h3>
                        Tempat Tumbuh,
                        Belajar dan Berkarya
                    </h3>
                    <p>
                        {{ $profile->deskripsi ?? $namaSekolah . ' merupakan sekolah menengah kejuruan yang berkomitmen dalam memberikan pendidikan dan keterampilan kepada peserta didik agar siap melanjutkan pendidikan maupun memasuki dunia kerja.' }}
                    </p>
                    <div class="school-info">
                        <div>
                            <i class="bi bi-person-badge-fill"></i>
                            <section>
                                <small>Kepala Sekolah</small>
                                <strong>{{ $kepalaSekolah }}</strong>
                            </section>
                        </div>
                        <div>
                            <i class="bi bi-card-heading"></i>
                            <section>
                                <small>NPSN</small>
                                <strong>{{ $npsn }}</strong>
                            </section>
                        </div>
                        <div>
                            <i class="bi bi-geo-alt-fill"></i>
                            <section>
                                <small>Alamat</small>
                                <strong>{{ $alamat }}</strong>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAM -->
<section class="program-section"
         id="program">
    <div class="container">
        <div class="section-header">
            <span>PROGRAM SEKOLAH</span>
            <h2>
                Pendidikan Sesuai Potensi Siswa
            </h2>
            <p>
                Mengembangkan keterampilan dan kreativitas
                untuk menghadapi dunia kerja.
            </p>
        </div>
        <div class="program-grid">
            <div class="program-card">
                <div class="program-icon">
                    <i class="bi bi-code-slash"></i>
                </div>
                <h3>
                    Teknologi & Informatika
                </h3>
                <p>
                    Mengembangkan kemampuan teknologi,
                    pemrograman, dan sistem informasi.
                </p>
                <span>
                    Pelajari lebih lanjut
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
            <div class="program-card">
                <div class="program-icon">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <h3>
                    Bisnis & Manajemen
                </h3>
                <p>
                    Membekali siswa dengan kemampuan
                    administrasi, bisnis, dan kewirausahaan.
                </p>
                <span>
                    Pelajari lebih lanjut
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
            <div class="program-card">
                <div class="program-icon">
                    <i class="bi bi-gear-fill"></i>
                </div>
                <h3>
                    Keahlian Profesional
                </h3>
                <p>
                    Pembelajaran praktik yang disesuaikan
                    dengan kebutuhan dunia kerja.
                </p>
                <span>
                    Pelajari lebih lanjut
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
        </div>
    </div>
</section>


<!-- GURU -->
<section class="teacher-section" id="guru">
    <div class="container">
        <div class="section-header">
            <span>TENAGA PENDIDIK</span>
            <h2>
                Guru & Tenaga Pengajar
            </h2>
            <p>
                Didukung oleh tenaga pendidik yang
                berkompeten dan profesional.
            </p>
        </div>
        <div class="teacher-grid">
            @forelse ($gurus as $guru)
                <div class="teacher-card">
                    <div class="teacher-photo">
                        <div class="teacher-photo">
                            @if ($guru->foto)
                                <img src="{{ asset('storage/guru/' . $guru->foto) }}"
                                    alt="{{ $guru->nama_guru }}">
                            @else
                                <div class="teacher-placeholder">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="teacher-info">
                        <h3>{{ $guru->nama_guru }}</h3>
                        <span>
                            {{ $guru->mapel ?? 'Tenaga Pendidik' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="teacher-empty">
                    <i class="bi bi-person-x"></i>
                    <p>Data guru belum tersedia.</p>
                </div>
            @endforelse
        </div>
        @if ($jumlahGuru > 5)
            <div class="teacher-more">
                <a href="{{ route('admin.guru.index') }}" class="btn-teacher-more">
                    Lihat Semua Guru
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- BERITA -->
<section class="news-section" id="berita">
    <div class="container">
        <div class="section-header section-header-row">
            <div>
                <span>INFORMASI TERBARU</span>
                <h2>
                    Berita Sekolah
                </h2>
            </div>
            <a href="#berita"
               class="view-all">
                Lihat Semua
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($beritas as $berita)
                <div class="col-lg-4 col-md-6">
                    <article class="news-card">
                        @if($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}"
                                 alt="{{ $berita->judul }}">
                        @else
                            <div class="news-placeholder">
                                <i class="bi bi-newspaper"></i>
                            </div>
                        @endif
                        <div class="news-content">
                            @if($berita->tanggal)
                                <small>
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
                                </small>
                            @endif
                            <h3>
                                {{ $berita->judul }}
                            </h3>
                            <p>
                                {{ Str::limit(strip_tags($berita->isi), 110) }}
                            </p>
                            <a href="#berita">
                                Baca Selengkapnya
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-box">
                        <i class="bi bi-newspaper"></i>
                        <h4>
                            Belum Ada Berita
                        </h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- GALERI -->
<section class="gallery-section"
         id="galeri">
    <div class="container">
        <div class="section-header">
            <span>DOKUMENTASI</span>
            <h2>
                Kegiatan Sekolah
            </h2>
            <p>
                Momen dan kegiatan {{ $namaSekolah }}.
            </p>
        </div>
        <div class="gallery-grid">
            @forelse($galeris as $galeri)
                <div class="gallery-card">
                    @if($galeri->file)
                        <img src="{{ asset('storage/' . $galeri->file) }}"
                             alt="{{ $galeri->judul }}">
                    @endif
                    <div class="gallery-caption">
                        <strong>
                            {{ $galeri->judul }}
                        </strong>
                        @if($galeri->tanggal)
                            <small>
                                {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}
                            </small>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-box">
                    <i class="bi bi-images"></i>
                    <h4>
                        Belum Ada Galeri
                    </h4>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">

                @if($profile && $profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}"
                         alt="Logo">
                @endif

                <div>
                    <strong>
                        {{ $namaSekolah }}
                    </strong>
                    <p>
                        Sistem Informasi Sekolah
                    </p>
                </div>
            </div>

            <div class="footer-links">
                <a href="#beranda">Beranda</a>
                <a href="#tentang">Tentang</a>
                <a href="#program">Program</a>
                <a href="#berita">Berita</a>
                <a href="#galeri">Galeri</a>
                <a href="#kontak">Kontak</a>
            </div>
        </div>

        <div class="footer-bottom">
            <span>
                &copy; {{ date('Y') }} {{ $namaSekolah }}
            </span>
            <span>
                NPSN {{ $npsn }}
            </span>
        </div>
    </div>

</footer>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>