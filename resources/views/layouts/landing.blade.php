<!DOCTYPE html>
<html lang="id">

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
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $landingProfile->logo) }}">


    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing-custom.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    @stack('styles')
</head>

<body>

    <nav class="landing-navbar">
        <div class="container">
            <div class="navbar-content">

                <a href="{{ route('landing') }}" class="school-logo">
                    @if($landingProfile && $landingProfile->logo)
                        <img src="{{ asset('storage/' . $landingProfile->logo) }}" alt="{{ $landingSchoolName }}">
                    @endif
                    <div>
                        <strong>{{ $landingSchoolName }}</strong>
                        <span>Tasikmalaya</span>
                    </div>
                </a>

                <div class="desktop-menu">
                    <a href="{{ route('landing') }}" class="{{ request()->routeIs('landing') ? 'active' : '' }}">
                        <i class="bi bi-house-fill"></i> Beranda
                    </a>

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
                        <i class="bi bi-flag-fill"></i> Ekstrakurikuler
                    </a>
                    <a href="{{ route('prestasi.index') }}"
                        class="{{ request()->routeIs('prestasi.*') ? 'active' : '' }}">
                        <i class="bi bi-trophy-fill"></i> Prestasi
                    </a>
                    <a href="{{ route('galeri.index') }}" class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                        <i class="bi bi-images"></i> Galeri
                    </a>
                    <a href="{{ route('landing.ujikom.index') }}"
                        class="{{ request()->routeIs('ujikom.*') ? 'active' : '' }}">
                        Ujikom
                    </a>
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login.*') ? 'active' : '' }}">
                        Login
                    </a>
                </div>

                <button class="mobile-nav-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#mobileNavbar" aria-controls="mobileNavbar">
                    <i class="bi bi-list"></i>
                </button>

            </div>
        </div>
    </nav>

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

    @yield('content')

    <footer class="school-footer">
        <div class="container">
            <div class="school-footer-main">

                <div class="school-footer-brand">
                    <div class="school-footer-logo">
                        @if($landingProfile && $landingProfile->logo)
                            <img src="{{ asset('storage/' . $landingProfile->logo) }}" alt="{{ $landingSchoolName }}">
                        @endif
                    </div>
                    <div class=".school-footer-brand-content">
                        <h3>{{ $landingSchoolName }}</h3>
                        <p>hadir untuk membentuk generasi yang unggul, berkarakter, dan berprestasi.</p>
                    </div>
                </div>
                <div class="school-footer-column">
                    <h4>Menu Utama</h4>
                    <a href="{{ route('landing') }}">Beranda <i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Berita <i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Pengumuman <i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('tentang') }}">Tentang<i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Guru <i class="bi bi-chevron-right"></i></a>
                </div>
                <div class="school-footer-column">
                    <h4>Informasi</h4>
                    <a href="{{ route('landing') }}">Berita <i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Pengumuman <i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Ekstrakurikuler<i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Prestasi<i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Galeri<i class="bi bi-chevron-right"></i></a>
                </div>
                <div class="school-footer-column">
                    <h4>Hubungi</h4>
                    <a href="{{ route('landing') }}">Berita <i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Pengumuman <i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Ekstrakurikuler<i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Prestasi<i class="bi bi-chevron-right"></i></a>
                    <a href="{{ route('landing') }}">Galeri<i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
            <div class="school-footer-bottom">
                <div>@ {{ date("Y")}} <strong>{{ $landingSchoolName }}</strong> Semua hak di lindungi</div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>

    @stack('scripts')

</body>

</html>