{{-- Mengambil master layout --}}
@extends('layouts.landing')

@section('content')

    {{-- SECTION 1: HERO --}}
    <section class="hero" id="beranda">
        @if ($heroImage)
            <img src="{{ asset('storage/' . $heroImage) }}" alt="{{ $namaSekolah }}" class="hero-image">
        @else
            <div class="hero-image hero-placeholder"></div>
        @endif

        <div class="hero-overlay"></div>

        <div class="container">
            <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                <div class="hero-label">SEKOLAH MENENGAH PERTAMA</div>
                <h1>Membangun Generasi <span>Unggul dan Berkarakter</span></h1>
                <p>{{ $namaSekolah }} hadir untuk membentuk generasi yang unggul, berkarakter, dan berprestasi.</p>

                <div class="hero-buttons">
                    <a href="#tentang" class="btn-main">Kenali Sekolah Kami <i class="bi bi-arrow-right"></i></a>
                    <a href="#guru" class="btn-outline">Lihat Guru</a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2: STATISTIK --}}
    <section class="stats-wrapper">
        <div class="container">
            <div class="stats-box">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                    <div><strong>{{ $jumlahSiswa }}+</strong> <span>Siswa</span></div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-icon"><i class="bi bi-person-workspace"></i></div>
                    <div><strong>{{ $jumlahGuru }}+</strong> <span>Guru & Staf</span></div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-icon"><i class="bi bi-trophy-fill"></i></div>
                    <div><strong>{{ $jumlahEkskul }}+</strong> <span>Ekstrakurikuler</span></div>
                </div>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-icon"><i class="bi bi-award-fill"></i></div>
                    <div><strong>{{ $profile->akreditasi ?? '-' }}</strong> <span>Akreditasi</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 3: TENTANG SEKOLAH --}}
    <section class="about-section" id="tentang">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>TENTANG SEKOLAH</span>
                <h2>Mengenal {{ $namaSekolah }}</h2>
                <p>Pendidikan untuk membentuk generasi yang kompeten dan berkarakter.</p>
            </div>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="about-visual" data-aos="fade-right">
                        <div class="about-image-main">
                            @if ($heroImage)
                                <img src="{{ asset('storage/' . $heroImage) }}" alt="Kegiatan sekolah">
                            @else
                                <div class="about-placeholder"><i class="bi bi-building"></i></div>
                            @endif
                        </div>

                        <div class="about-badge">
                            <strong>{{ $namaSekolah }}</strong>
                            <span>Tasikmalaya</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-content" data-aos="fade-left">
                        <span class="content-label">PROFIL SEKOLAH</span>
                        <h3>Tempat Tumbuh, Belajar dan Berkarya</h3>
                        <p>{{ $profile->deskripsi ?? 'Profil sekolah belum tersedia.' }}</p>

                        <div class="school-info">
                            <div>
                                <i class="bi bi-person-badge-fill"></i>
                                <div><small>Kepala Sekolah</small><strong>{{ $kepalaSekolah }}</strong></div>
                            </div>
                            <div>
                                <i class="bi bi-card-heading"></i>
                                <div><small>NPSN</small><strong>{{ $npsn }}</strong></div>
                            </div>
                            <div>
                                <i class="bi bi-geo-alt-fill"></i>
                                <div><small>Alamat</small><strong>{{ $alamat }}</strong></div>
                            </div>
                        </div>

                        <a href="{{ route('tentang') }}" class="btn-main">
                            Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 4: GURU --}}
    <section class="teacher-section" id="guru">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>TENAGA PENDIDIK</span>
                <h2>Guru & Tenaga Pengajar</h2>
                <p>Didukung oleh tenaga pendidik yang berkompeten dan profesional.</p>
            </div>

            <div class="teacher-grid" data-aos="fade-up">
                @forelse ($gurus as $guru)
                    <div class="teacher-card">
                        <a href="{{ route('guru.show', $guru->encrypted_id) }}">
                            <div class="teacher-photo">
                                @if ($guru->foto)
                                    <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}">
                                @else
                                    <div class="teacher-placeholder">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </div>
                        </a>

                        <a href="{{ route('guru.show', $guru->encrypted_id) }}" class="text-decoration-none text-dark">
                            <div class="teacher-info">
                                <h3>{{ $guru->nama_guru }}</h3>
                                <span>{{ $guru->mapel ?? 'Tenaga Pendidik' }}</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="teacher-empty">
                        <i class="bi bi-person-x"></i>
                        <p>Data guru belum tersedia.</p>
                    </div>
                @endforelse
            </div>

            @if (isset($gurus) && $gurus->count() > 0)
                <div class="section-footer" data-aos="fade-up">
                    <a href="{{ route('guru.index') }}" class="btn-main">
                        Lihat Semua Guru <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- SECTION 5: EKSTRAKURIKULER --}}
    <section class="ekskul-section" id="ekstrakurikuler">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>KEGIATAN SEKOLAH</span>
                <h2>Ekstrakurikuler</h2>
                <p>Berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat, minat, dan potensi siswa {{ $namaSekolah }}.</p>
            </div>

            <div class="ekskul-grid" data-aos="fade-up">
                @forelse ($ekstrakurikulers as $ekstrakurikuler)
                    <div class="ekskul-card">
                        <a href="{{ route('ekstrakurikuler.show', $ekstrakurikuler->slug ?? $ekstrakurikuler->encrypted_id) }}">
                            <div class="ekskul-image">
                                @if ($ekstrakurikuler->gambar)
                                    <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_ekskul }}">
                                @else
                                    <div class="gallery-placeholder"><i class="bi bi-stars"></i></div>
                                @endif
                            </div>
                        </a>

                        <div class="ekskul-content">
                            <a href="{{ route('ekstrakurikuler.show', $ekstrakurikuler->slug ?? $ekstrakurikuler->encrypted_id) }}" class="text-decoration-none text-dark">
                                <h3>{{ $ekstrakurikuler->nama_ekskul }}</h3>
                            </a>

                            @if ($ekstrakurikuler->deskripsi)
                                <p>{{ Str::limit(strip_tags($ekstrakurikuler->deskripsi), 100) }}</p>
                            @endif

                            <a href="{{ route('ekstrakurikuler.show', $ekstrakurikuler->slug ?? $ekstrakurikuler->encrypted_id) }}" class="ekskul-link">
                                Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-box">
                        <i class="bi bi-stars"></i>
                        <h4>Belum Ada Ekstrakurikuler</h4>
                        <p>Data ekstrakurikuler belum tersedia.</p>
                    </div>
                @endforelse
            </div>

            @if (isset($ekstrakurikulers) && $ekstrakurikulers->count() > 0)
                <div class="section-footer" data-aos="fade-up">
                    <a href="{{ route('ekstrakurikuler.index') }}" class="btn-main">
                        Lihat Semua Ekstrakurikuler <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- SECTION 6: INFORMASI TERBARU --}}
    <section class="information-section" id="prestasi">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>INFORMASI SEKOLAH</span>
                <h2>Informasi Terbaru</h2>
                <p>Informasi, prestasi, dan berita terbaru {{ $namaSekolah }}.</p>
            </div>

            <div class="information-grid">

                {{-- PENGUMUMAN --}}
                <div class="information-card" id="pengumuman" data-aos="fade-up">
                    <div class="information-title"><h3>Pengumuman</h3></div>
                    <div class="information-line"></div>

                    <div class="information-list">
                        @forelse ($pengumumans as $pengumuman)
                            <div class="information-item">
                                <h4>
                                    <a href="{{ route('pengumuman.show', $pengumuman->encrypted_id) }}"
                                    class="text-decoration-none text-dark">
                                        {{ $pengumuman->judul ?? $pengumuman->nama_pengumuman ?? 'Pengumuman Sekolah' }}
                                    </a>
                                </h4>

                                @if ($pengumuman->tanggal)
                                    <span class="information-date">
                                        <i class="bi bi-calendar3"></i>
                                        {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') }}
                                    </span>
                                @endif

                                @if (!empty($pengumuman->isi))
                                    <p>{{ Str::limit(strip_tags($pengumuman->isi), 100) }}</p>
                                @elseif (!empty($pengumuman->deskripsi))
                                    <p>{{ Str::limit(strip_tags($pengumuman->deskripsi), 100) }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="information-empty">
                                <i class="bi bi-megaphone"></i>
                                <p>Belum ada pengumuman.</p>
                            </div>
                        @endforelse
                    </div>

                    @if (isset($pengumumans) && $pengumumans->count() > 0)
                        <a href="{{ route('pengumuman.index') }}" class="information-more">» Lihat Semua Pengumuman</a>
                    @endif
                </div>

                {{-- PRESTASI --}}
                <div class="information-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="information-title"><h3>Prestasi</h3></div>
                    <div class="information-line"></div>

                    <div class="information-list">
                        @forelse ($prestasis as $prestasi)
                            <a href="{{ route('prestasi.show', $prestasi->slug ?? $prestasi->encrypted_id) }}" class="information-item achievement-item text-decoration-none text-dark">
                                <div class="achievement-small-icon"><i class="bi bi-trophy-fill"></i></div>
                                <div>
                                    <h4>{{ $prestasi->nama_prestasi ?? $prestasi->judul ?? $prestasi->prestasi ?? 'Prestasi Sekolah' }}</h4>

                                    @if (!empty($prestasi->tahun_ajaran))
                                        <span class="information-date">
                                            <i class="bi bi-calendar3"></i> {{ $prestasi->tahun_ajaran }}
                                        </span>
                                    @endif

                                    @if (!empty($prestasi->tingkat))
                                        <span class="achievement-level">
                                            <i class="bi bi-award"></i> {{ $prestasi->tingkat }}
                                        </span>
                                    @endif

                                    @if (!empty($prestasi->keterangan))
                                        <p>{{ Str::limit($prestasi->keterangan, 90) }}</p>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="information-empty">
                                <i class="bi bi-trophy"></i>
                                <p>Belum ada prestasi.</p>
                            </div>
                        @endforelse
                    </div>

                    @if (isset($prestasis) && $prestasis->count() > 0)
                        <a href="{{ route('prestasi.index') }}" class="information-more">» Lihat Semua Prestasi</a>
                    @endif
                </div>

                {{-- BERITA --}}
                <div class="information-card" id="berita" data-aos="fade-up" data-aos-delay="200">
                    <div class="information-title"><h3>Berita</h3></div>
                    <div class="information-line"></div>

                    <div class="information-news">
                        @forelse ($beritas as $berita)
                            <article class="information-news-item">
                                @if ($berita->foto)
                                    <a href="{{ route('berita.show', $berita->slug ?? $berita->encrypted_id) }}">
                                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">
                                    </a>
                                @else
                                    <div class="information-news-placeholder"><i class="bi bi-newspaper"></i></div>
                                @endif

                                <div class="information-news-content">
                                    @if ($berita->tanggal)
                                        <span class="information-date">
                                            <i class="bi bi-calendar3"></i>
                                            {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
                                        </span>
                                    @endif

                                    <h4>
                                        <a href="{{ route('berita.show', $berita->slug ?? $berita->encrypted_id) }}" class="text-decoration-none text-dark">
                                            {{ $berita->judul }}
                                        </a>
                                    </h4>

                                    <p>{{ Str::limit(strip_tags($berita->isi), 90) }}</p>

                                    <a href="{{ route('berita.show', $berita->slug ?? $berita->encrypted_id) }}">Selengkapnya »</a>
                                </div>
                            </article>
                        @empty
                            <div class="information-empty">
                                <i class="bi bi-newspaper"></i>
                                <p>Belum ada berita.</p>
                            </div>
                        @endforelse
                    </div>

                    @if (isset($beritas) && $beritas->count() > 0)
                        <a href="{{ route('berita.index') }}" class="information-more">» Lihat Semua Berita</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 7: GALERI --}}
    <section class="gallery-section" id="galeri">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>DOKUMENTASI</span>
                <h2>Kegiatan Sekolah</h2>
                <p>Momen dan kegiatan {{ $namaSekolah }}.</p>
            </div>

            <div class="gallery-grid" data-aos="fade-up">
                @forelse ($galeris as $galeri)
                    <div class="gallery-card">
                        @if ($galeri->file)
                            @php
                                $extension = strtolower(pathinfo($galeri->file, PATHINFO_EXTENSION));
                                $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov', 'mkv']);
                            @endphp

                            @if ($isVideo)
                                <div class="gallery-video-wrapper" style="width: 100%; height: 100%;">
                                    <video width="100%" height="100%" controls style="object-fit: cover;">
                                        <source src="{{ asset('storage/' . $galeri->file) }}" type="{{ $extension === 'mov' ? 'video/mp4' : 'video/' . $extension }}">
                                        Browser Anda tidak mendukung pemutaran video.
                                    </video>
                                </div>
                            @else
                                <a href="{{ route('galeri.show', $galeri->slug ?? $galeri->encrypted_id) }}">
                                    <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}">
                                </a>
                            @endif
                        @else
                            <div class="gallery-placeholder"><i class="bi bi-images"></i></div>
                        @endif

                        <a href="{{ route('galeri.show', $galeri->slug ?? $galeri->encrypted_id) }}" class="gallery-caption text-decoration-none text-dark">
                            <strong>{{ $galeri->judul }}</strong>

                            @if ($galeri->tanggal)
                                <small>{{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}</small>
                            @endif
                        </a>
                    </div>
                @empty
                    <div class="empty-box">
                        <i class="bi bi-images"></i>
                        <h4>Belum Ada Galeri</h4>
                    </div>
                @endforelse
            </div>

            @if (isset($galeris) && $galeris->count() > 0)
                <div class="section-footer" data-aos="fade-up">
                    <a href="{{ route('galeri.index') }}" class="btn-main">
                        Lihat Semua Galeri <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- SECTION 8: KONTAK --}}
    <section class="contact-section" id="kontak">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>KONTAK</span>
                <h2>Hubungi {{ $namaSekolah }}</h2>
                <p>Informasi kontak dan alamat sekolah.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8" data-aos="fade-up">
                    <div class="school-info">
                        <div>
                            <i class="bi bi-geo-alt-fill"></i>
                            <div><small>Alamat</small><strong>{{ $alamat }}</strong></div>
                        </div>

                        <div>
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <small>Kontak</small>
                                <strong>
                                    <a href="tel:{{ $kontak }}" class="text-decoration-none text-dark">{{ $kontak }}</a>
                                </strong>
                            </div>
                        </div>

                        <div>
                            <i class="bi bi-card-heading"></i>
                            <div><small>NPSN</small><strong>{{ $npsn }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
