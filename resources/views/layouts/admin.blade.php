<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Sekolah">
    <title>Dashboard | Admin Sekolah</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>

        <!-- SIDEBAR -->
        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <!-- BRAND -->
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin.dashboard') }}" aria-label="Admin Sekolah">
                    <span class="brand-icon">
                        <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                    </span>
                    <span class="brand-copy">
                        <span class="brand-title">ADMIN SEKOLAH</span>
                        <span class="brand-subtitle">Sistem Informasi Sekolah</span>
                    </span>
                </a>
            </div>

            <!-- MENU -->
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    id="menu-dashboard" title="Dashboard">
                    <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>

                <a href="{{ route('admin.user.index') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" id="menu-user"
                    title="Kelola User">
                    <span class="nav-icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola User</span>
                </a>

                <a href="{{ route('admin.profil.index') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.profil') ? 'active' : '' }}" id="menu-profil"
                    title="Profil Sekolah">
                    <span class="nav-icon"><i class="bi bi-building-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Profil Sekolah</span>
                </a>

                <a href="{{ route('admin.guru') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.guru') ? 'active' : '' }}" id="menu-guru"
                    title="Kelola Guru">
                    <span class="nav-icon"><i class="bi bi-person-workspace" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Guru</span>
                </a>

                <a href="{{ route('admin.siswa.index') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.siswa') ? 'active' : '' }}" id="menu-siswa"
                    title="Kelola Siswa">
                    <span class="nav-icon"><i class="bi bi-people-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Siswa</span>
                </a>

                <a href="{{ route('admin.berita') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.berita') ? 'active' : '' }}" id="menu-berita"
                    title="Kelola Berita">
                    <span class="nav-icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Berita</span>
                </a>

                <a href="{{ route('admin.galeri') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.galeri') ? 'active' : '' }}" id="menu-galeri"
                    title="Kelola Galeri">
                    <span class="nav-icon"><i class="bi bi-images" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Galeri</span>
                </a>

                <a href="{{ route('admin.ekstrakurikuler') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.ekstrakurikuler') ? 'active' : '' }}"
                    id="menu-ekstrakurikuler" title="Kelola Ekstrakurikuler">
                    <span class="nav-icon"><i class="bi bi-trophy-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Ekstrakurikuler</span>
                </a>

                <a href="{{ route('admin.pengumuman') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.pengumuman') ? 'active' : '' }}"
                    id="menu-pengumuman" title="Kelola Pengumuman">
                    <span class="nav-icon"><i class="bi bi-megaphone-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Pengumuman</span>
                </a>

                <a href="{{ route('admin.prestasi') }}"
                    class="sidebar-menu-link {{ request()->routeIs('admin.prestasi') ? 'active' : '' }}"
                    id="menu-prestasi" title="Kelola Prestasi">
                    <span class="nav-icon"><i class="bi bi-award-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Kelola Prestasi</span>
                </a>
            </nav>

            <!-- USER -->
            <div class="sidebar-user">
                <img class="avatar-img avatar-md sidebar-user-avatar"
                    src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="Admin Sekolah">
                <strong>Admin Sekolah</strong>
                <small>Administrator</small>
            </div>

            <!-- STATUS -->
            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span class="sidebar-footer-text">Sistem berjalan normal</span>
            </div>
        </aside>

        <!-- MAIN MAIN CONTENT AREA -->
        <div class="admin-main">
            <!-- NAVBAR -->
            <nav class="navbar admin-navbar navbar-expand bg-white">
                <div class="container-fluid px-3 px-lg-4">
                    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar"
                        aria-expanded="true" aria-label="Toggle sidebar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <!-- SEARCH -->
                    <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
                        <input class="form-control search-input" type="search" placeholder="Cari data sekolah..."
                            aria-label="Search">
                    </form>

                    <div class="navbar-actions ms-auto">
                        <!-- THEME -->
                        <button class="icon-button theme-toggle" type="button" data-theme-toggle
                            aria-label="Switch color theme" title="Ganti tema">
                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
                        </button>

                        <!-- NOTIFICATION -->
                        <div class="dropdown">
                            <button class="icon-button" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="Notifications">
                                <span class="notification-dot"></span>
                                <i class="bi bi-bell" aria-hidden="true"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end notification-menu">
                                <div class="dropdown-header fw-bold text-body">
                                    Notifikasi Sekolah
                                </div>

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

                        <!-- PROFILE -->
                        <div class="dropdown">
                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="avatar-img avatar-sm"
                                    src="{{ asset('assets/images/avatar/avatar.jpg') }}" alt="Admin Sekolah">
                                <span class="profile-name d-none d-sm-inline">Admin Sekolah</span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i>Profil Admin
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear me-2"></i>Pengaturan
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">

                                        @csrf

                                        <button type="submit" class="dropdown-item">

                                            <i class="bi bi-box-arrow-right me-2"></i>

                                            Logout

                                        </button>

                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- CONTENT -->
            @yield('content')

            <!-- FOOTER -->
            <footer class="admin-footer">
                <div class="container-fluid px-3 px-lg-4">
                    <span>
                        Copyright {{ date('Y') }} Admin Sekolah. <br>
                        Sistem Informasi Sekolah
                    </span>
                    <span>Admin Panel Sekolah.</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
