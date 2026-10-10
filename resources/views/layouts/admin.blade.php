<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Sekolah">
    <title>website | Admin Sekolah</title>

    {{-- CSS Bootstrap, Bootstrap Icons, dan Style Admin --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <div class="admin-shell">

        {{-- Backdrop untuk menutup sidebar di layar mobile --}}
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <!-- SIDEBAR UTAMA -->
        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">

            {{-- HEADER SIDEBAR: Logo & Nama Sekolah --}}
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin.dashboard') }}" aria-label="Profil Sekolah">
                    <span class="brand-icon">
                        {{-- Ambil data profil sekolah dari database --}}
                        @php
                            $sidebarProfile = \App\Models\Profile::first();
                        @endphp

                        @if($sidebarProfile && $sidebarProfile->logo)
                            <img src="{{ asset('storage/' . $sidebarProfile->logo) }}" alt="Logo Sekolah" style="width: 42px; height: 42px; object-fit: contain;">
                        @else
                            <i class="bi bi-building-fill"></i>
                        @endif
                    </span>

                    <span class="brand-copy">
                        <span class="brand-title">{{ $sidebarProfile->nama_sekolah ?? 'SMK YPC TASIKMALAYA' }}</span>
                        <span class="brand-subtitle">Sistem Informasi Sekolah</span>
                    </span>
                </a>
            </div>

            {{-- NAVIGASI SIDEBAR --}}
            <nav class="sidebar-nav">

                <div class="sidebar-section-title">MENU UTAMA</div>

                {{-- DASHBOARD --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   id="menu-dashboard" title="Dashboard">
                    <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>

                <div class="sidebar-section-title">MANAJEMEN</div>

                {{-- KELOLA USER (Hanya Tampil Jika Hak Akses = Admin) --}}
                @if(Auth::user()->role == 'Admin')
                    <a href="{{ route('admin.user.index') }}"
                       class="sidebar-menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}"
                       id="menu-user" title="Kelola Pengguna">
                        <span class="nav-icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
                        <span class="nav-text">Kelola Pengguna</span>
                    </a>
                @endif

                {{-- PROFIL SEKOLAH --}}
                <a href="{{ route('admin.profilsekolah') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.profilsekolah') ? 'active' : '' }}"
                   id="menu-profil" title="Profil Sekolah">
                    <span class="nav-icon"><i class="bi bi-building-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Profil Sekolah</span>
                </a>

                {{-- KELOLA GURU --}}
                <a href="{{ route('admin.guru.index') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.guru.index') ? 'active' : '' }}"
                   id="menu-guru" title="Kelola Guru">
                    <span class="nav-icon"><i class="bi bi-person-workspace" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Guru</span>
                </a>

                {{-- KELOLA SISWA --}}
                <a href="{{ route('admin.siswa.index') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}"
                   id="menu-siswa" title="Kelola Siswa">
                    <span class="nav-icon"><i class="bi bi-people-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Siswa</span>
                </a>

                <div class="sidebar-section-title">KONTEN SEKOLAH</div>

                {{-- KELOLA BERITA --}}
                <a href="{{ route('admin.berita') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.berita') ? 'active' : '' }}"
                   id="menu-berita" title="Kelola Berita">
                    <span class="nav-icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Berita</span>
                </a>

                {{-- KELOLA GALERI --}}
                <a href="{{ route('admin.galeri') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.galeri') ? 'active' : '' }}"
                   id="menu-galeri" title="Kelola Galeri">
                    <span class="nav-icon"><i class="bi bi-images" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Galeri</span>
                </a>

                {{-- KELOLA EKSTRAKURIKULER --}}
                <a href="{{ route('admin.ekstrakurikuler') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.ekstrakurikuler') ? 'active' : '' }}"
                   id="menu-ekstrakurikuler" title="Kelola Ekstrakurikuler">
                    <span class="nav-icon"><i class="bi bi-trophy-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Ekstrakurikuler</span>
                </a>

                {{-- KELOLA PENGUMUMAN --}}
                <a href="{{ route('admin.pengumuman') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.pengumuman') ? 'active' : '' }}"
                   id="menu-pengumuman" title="Kelola Pengumuman">
                    <span class="nav-icon"><i class="bi bi-megaphone-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Pengumuman</span>
                </a>

                {{-- KELOLA PRESTASI --}}
                <a href="{{ route('admin.prestasi') }}"
                   class="sidebar-menu-link {{ request()->routeIs('admin.prestasi') ? 'active' : '' }}"
                   id="menu-prestasi" title="Kelola Prestasi">
                    <span class="nav-icon"><i class="bi bi-award-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Prestasi</span>
                </a>
            </nav>

            {{-- INFORMASI AKUN USER LLOGIN --}}
            <div class="sidebar-user">
                <img class="avatar-img avatar-md sidebar-user-avatar"
                     src="{{ asset('assets/images/avatar/avatar-fallback.jpg') }}"
                     alt="{{ auth()->user()->username ?? 'Admin' }}">
                <strong>{{ auth()->user()->username ?? 'Admin' }}</strong>
                <small>{{ auth()->user()->role ?? 'Administrator' }}</small>
            </div>

            {{-- STATUS SISTEM --}}
            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span class="sidebar-footer-text">Sistem berjalan normal</span>
            </div>

        </aside>

        <!-- KONTEN UTAMA ADMIN -->
        <div class="admin-main">

            <!-- NAVBAR ATAS -->
            <nav class="navbar admin-navbar navbar-expand bg-white">
                <div class="container-fluid px-3 px-lg-4">

                    {{-- Tombol Buka/Tutup Sidebar --}}
                    <button class="sidebar-toggle" type="button" data-sidebar-toggle
                            aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle sidebar">
                        <span></span><span></span><span></span>
                    </button>

                    {{-- Form Pencarian Global Data Sekolah --}}
                    <form action="{{ route('admin.search') }}" method="GET" class="d-none d-md-flex ms-3 flex-grow-1" role="search">
                        <input class="form-control search-input" type="search" name="q"
                               value="{{ request('q') }}" placeholder="Cari data sekolah..." aria-label="Search">
                    </form>

                    <div class="navbar-actions ms-auto">

                        {{-- Tombol Switch Tema (Gelap/Terang) --}}
                        <button class="icon-button theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Ganti tema">
                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
                        </button>

                        {{-- Dropdown Notifikasi Pintasan Konten --}}
                        <div class="dropdown">
                            <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                                <span class="notification-dot"></span>
                                <i class="bi bi-bell" aria-hidden="true"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end notification-menu">
                                <div class="dropdown-header fw-bold text-body">Notifikasi Sekolah</div>
                                <a class="dropdown-item" href="{{ route('admin.pengumuman') }}">
                                    <span class="notification-title">Pengumuman Sekolah</span>
                                    <span class="notification-time">Informasi terbaru sekolah</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.berita') }}">
                                    <span class="notification-title">Berita Sekolah</span>
                                    <span class="notification-time">Informasi berita terbaru</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.prestasi') }}">
                                    <span class="notification-title">Prestasi Siswa</span>
                                    <span class="notification-time">Data prestasi sekolah</span>
                                </a>
                            </div>
                        </div>

                        {{-- Dropdown Profil & Akun Admin --}}
                        <div class="dropdown">
                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="avatar-img avatar-sm" src="{{ asset('assets/images/avatar/avatar-fallback.jpg') }}" alt="{{ auth()->user()->username ?? 'Admin' }}">
                                <span class="profile-name d-none d-sm-inline">{{ auth()->user()->username ?? 'Admin' }}</span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <i class="bi bi-person me-2"></i> Profil Admin
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                        <i class="bi bi-gear me-2"></i> Pengaturan
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                {{-- Form Tombol Logout --}}
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </nav>

            {{-- Slot Konten Dinamis Halaman Admin --}}
            @yield('content')

            <!-- FOOTER ADMIN -->
            <footer class="admin-footer">
                <div class="container-fluid px-3 px-lg-4">
                    <span>Copyright {{ date('Y') }} Admin Sekolah.<br>Sistem Informasi Sekolah</span>
                    <span>Admin Panel Sekolah.</span>
                </div>
            </footer>

        </div>

    </div>

    <!-- JAVASCRIPT UTAMA -->
    <script>
        // Data global user untuk script JS lokal
        window.adminHMDUser = {
            name: @json(auth()->user()->username ?? 'Admin'),
            workspace: @json(auth()->user()->role ?? 'Administrator'),
            avatar: @json(asset('assets/images/avatar/avatar-fallback.jpg'))
        };
    </script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>