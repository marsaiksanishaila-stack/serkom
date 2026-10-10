<!DOCTYPE html>
<html lang="id">

{{-- Ambil data profil sekolah pertama dari database untuk variabel global layout --}}
@php
    $landingProfile = \App\Models\Profile::first();
    $landingSchoolName = $landingProfile->nama_sekolah ?? 'SMPN 2 Mangunreja';
    $landingNpsn = $landingProfile->npsn ?? '-';
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $landingSchoolName }}">
    <title>{{ $landingSchoolName }}</title>

    {{-- File CSS Bootstrap, Ikon, dan Style khusus landing page --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing-custom.css') }}">

    {{-- Library CSS AOS untuk animasi efek scroll --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    {{-- Slot CSS tambahan untuk halaman anak --}}
    @stack('styles')
</head>

<body>

    {{-- NAVBAR UTAMA (TAMPILAN DESKTOP) --}}
    <nav class="landing-navbar">
        <div class="container">
            <div class="navbar-content">

                {{-- Logo & Nama Sekolah --}}
                <a href="{{ route('landing') }}" class="school-logo">
                    @if($landingProfile && $landingProfile->logo)
                        <img src="{{ asset('storage/' . $landingProfile->logo) }}" alt="{{ $landingSchoolName }}">
                    @endif
                    <div>
                        <strong>{{ $landingSchoolName }}</strong>
                        <span>Tasikmalaya</span>
                    </div>
                </a>

                {{-- Menu Navigasi Desktop --}}
                <div class="desktop-menu">
                    <a href="{{ route('landing') }}" class="{{ request()->routeIs('landing') ? 'active' : '' }}">
                        <i class="bi bi-house-fill"></i> Beranda
                    </a>

                    {{-- Menu Dropdown Informasi (Berita & Pengumuman) --}}
                    <div
                        class="nav-dropdown {{ request()->routeIs('berita.*') || request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="bi bi-newspaper"></i> Informasi <i class="bi bi-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="dropdown-menu-custom">
                            <a href="{{ route('berita.index') }}"
                                class="{{ request()->routeIs('berita.*') ? 'active' : '' }}">
                                <i class="bi bi-newspaper"></i> Berita
                            </a>
                            <a href="{{ route('pengumuman.index') }}"
                                class="{{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                                <i class="bi bi-megaphone-fill"></i> Pengumuman
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">
                        <i class="bi bi-info-circle-fill"></i> Tentang
                    </a>
                    <a href="{{ route('guru.index') }}" class="{{ request()->routeIs('guru.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Guru
                    </a>
                    <a href="{{ route('ekstrakurikuler.index') }}"
                        class="{{ request()->routeIs('ekstrakurikuler.*') ? 'active' : '' }}">
                        <i class="bi bi-person-arms-up"></i> Ekstrakurikuler
                    </a>
                    <a href="{{ route('prestasi.index') }}"
                        class="{{ request()->routeIs('prestasi.*') ? 'active' : '' }}">
                        <i class="bi bi-trophy-fill"></i> Prestasi
                    </a>
                    <a href="{{ route('galeri.index') }}" class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                        <i class="bi bi-images"></i> Galeri
                    </a>
                </div>

                {{-- Tombol Hamburger Menu untuk layar HP --}}
                <button class="mobile-nav-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#mobileNavbar" aria-controls="mobileNavbar">
                    <i class="bi bi-list"></i>
                </button>

            </div>
        </div>
    </nav>

    {{-- MENU SIDEBAR SLIDE (OFFCANVAS MOBILE) --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNavbar" aria-labelledby="mobileNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold text-success" id="mobileNavbarLabel">
                <i class="bi bi-building-fill me-2"></i> Menu Navigasi
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="mobile-menu-links">
                <a href="{{ route('landing') }}" class="{{ request()->routeIs('landing') ? 'active' : '' }}">
                    <i class="bi bi-house-fill"></i> Beranda
                </a>

                {{-- Submenu Informasi versi Mobile (Collapse / Accordion) --}}
                <div>
                    <a class="d-flex justify-content-between align-items-center {{ request()->routeIs('berita.*') || request()->routeIs('pengumuman.*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#mobileSubmenuInformasi" role="button" aria-expanded="false">
                        <span><i class="bi bi-newspaper"></i> Informasi</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <div class="collapse mobile-submenu {{ request()->routeIs('berita.*') || request()->routeIs('pengumuman.*') ? 'show' : '' }}"
                        id="mobileSubmenuInformasi">
                        <a href="{{ route('berita.index') }}"
                            class="{{ request()->routeIs('berita.*') ? 'active' : '' }}">
                            <i class="bi bi-newspaper"></i> Berita
                        </a>
                        <a href="{{ route('pengumuman.index') }}"
                            class="{{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                            <i class="bi bi-megaphone-fill"></i> Pengumuman
                        </a>
                    </div>
                </div>

                <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">
                    <i class="bi bi-info-circle-fill"></i> Tentang
                </a>
                <a href="{{ route('guru.index') }}" class="{{ request()->routeIs('guru.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Guru
                </a>
                <a href="{{ route('ekstrakurikuler.index') }}"
                    class="{{ request()->routeIs('ekstrakurikuler.*') ? 'active' : '' }}">
                    <i class="bi bi-person-arms-up"></i> Ekstrakurikuler
                </a>
                <a href="{{ route('prestasi.index') }}" class="{{ request()->routeIs('prestasi.*') ? 'active' : '' }}">
                    <i class="bi bi-trophy-fill"></i> Prestasi
                </a>
                <a href="{{ route('galeri.index') }}" class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Galeri
                </a>
            </div>
        </div>
    </div>

    {{-- WADAH UTAMA KONTEN --}}
    @yield('content')

    {{-- FOOTER SEKOLAH --}}
    <footer class="school-footer">
        <div class="container">
            <div class="school-footer-main">

                {{-- Kolom 1: Identitas & Deskripsi Sekolah --}}
                <div class="school-footer-brand">
                    <div class="school-footer-logo">
                        @if($landingProfile && $landingProfile->logo)
                            <img src="{{ asset('storage/' . $landingProfile->logo) }}" alt="{{ $landingSchoolName }}">
                        @endif
                    </div>
                    <div class="school-footer-brand-content">
                        <h3>{{ $landingSchoolName }}</h3>
                        <p>Membangun generasi yang berkarakter, berprestasi, mandiri, dan siap menghadapi masa depan.
                        </p>
                    </div>
                </div>

                {{-- Kolom 2: Tautan Menu Utama --}}
                <div class="school-footer-column">
                    <h4>Menu Utama</h4>
                    <a href="{{ route('landing') }}"><i class="bi bi-chevron-right"></i> Beranda</a>
                    <a href="{{ route('tentang') }}"><i class="bi bi-chevron-right"></i> Tentang Sekolah</a>
                    <a href="{{ route('guru.index') }}"><i class="bi bi-chevron-right"></i> Guru</a>
                    <a href="{{ route('prestasi.index') }}"><i class="bi bi-chevron-right"></i> Prestasi</a>
                </div>

                {{-- Kolom 3: Tautan Informasi --}}
                <div class="school-footer-column">
                    <h4>Informasi</h4>
                    <a href="{{ route('berita.index') }}"><i class="bi bi-chevron-right"></i> Berita</a>
                    <a href="{{ route('pengumuman.index') }}"><i class="bi bi-chevron-right"></i> Pengumuman</a>
                    <a href="{{ route('galeri.index') }}"><i class="bi bi-chevron-right"></i> Galeri</a>
                    <a href="{{ route('ekstrakurikuler.index') }}"><i class="bi bi-chevron-right"></i>
                        Ekstrakurikuler</a>
                </div>

                {{-- Kolom 4: Kontak Sekolah --}}
                <div class="school-footer-column school-footer-contact">
                    <h4>Hubungi Kami</h4>
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <span>{{ $landingProfile->alamat ?? 'Kabupaten Tasikmalaya, Jawa Barat' }}</span>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="bi bi-telephone-fill"></i></div>
                        <span>{{ $landingProfile->kontak ?? '-' }}</span>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="bi bi-credit-card-2-front-fill"></i></div>
                        <span>NPSN {{ $landingNpsn }}</span>
                    </div>
                </div>

            </div>

            {{-- Bagian Bawah Footer (Hak Cipta & Sosmed) --}}
            <div class="school-footer-bottom">
                <div>
                    © {{ date('Y') }} <strong>{{ $landingSchoolName }}</strong> · Semua Hak Dilindungi
                </div>
            </div>
        </div>
    </footer>

    {{-- File Javascript Bootstrap & Library AOS --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- Inisialisasi Efek Animasi AOS --}}
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>

    {{-- Slot Script tambahan untuk halaman anak --}}
    @stack('scripts')

</body>

</html>