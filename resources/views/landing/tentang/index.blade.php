{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

    {{-- SECTION TENTANG SEKOLAH --}}
    <section class="about-page-section">
        <div class="container">

            {{-- Header Section --}}
            <div class="section-heading">
                <span class="content-label">TENTANG SEKOLAH</span>
                <h2>Profil {{ $namaSekolah ?? 'Sekolah' }}</h2>
                <p>
                    Mengenal lebih dekat profil, visi, misi, dan informasi
                    {{ $namaSekolah ?? 'sekolah' }}.
                </p>
            </div>

            {{-- Grid Profil Sekolah --}}
            <div class="about-page-grid">

                {{-- Foto Profil / Gedung Sekolah --}}
                <div class="about-page-image" data-aos="fade-right" data-aos-duration="800">
                    @if($profile && $profile->foto)
                        <img src="{{ asset('storage/' . $profile->foto) }}" alt="{{ $namaSekolah }}" loading="lazy">
                    @else
                        <div class="about-page-placeholder">
                            <i class="bi bi-building"></i>
                        </div>
                    @endif
                </div>

                {{-- Informasi Singkat Profil Sekolah --}}
                <div class="about-page-content" data-aos="fade-left" data-aos-duration="800">
                    <span class="about-page-subtitle">PROFIL SEKOLAH</span>
                    <h2>{{ $namaSekolah }}</h2>

                    <p>{{ $profile->deskripsi ?? 'Belum ada deskripsi sekolah.' }}</p>

                    {{-- Informasi Kontak & Identitas Singkat --}}
                    <div class="about-page-info">

                        {{-- Kepala Sekolah --}}
                        <div class="about-info-item">
                            <i class="bi bi-person-badge"></i>
                            <div>
                                <span>Kepala Sekolah</span>
                                <strong>{{ $kepalaSekolah }}</strong>
                            </div>
                        </div>

                        {{-- NPSN --}}
                        <div class="about-info-item">
                            <i class="bi bi-card-text"></i>
                            <div>
                                <span>NPSN</span>
                                <strong>{{ $npsn }}</strong>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="about-info-item">
                            <i class="bi bi-geo-alt"></i>
                            <div>
                                <span>Alamat</span>
                                <strong>{{ $alamat }}</strong>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="about-info-item">
                            <i class="bi bi-telephone"></i>
                            <div>
                                <span>Kontak</span>
                                <strong>{{ $kontak }}</strong>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- SECTION VISI & MISI --}}
    <section class="vision-mission-section">
        <div class="container">

            <div class="section-heading">
                <span>ARAH SEKOLAH</span>
                <h2>Visi & Misi</h2>
                <p>
                    Landasan dan tujuan {{ $namaSekolah ?? 'sekolah' }}
                    dalam memberikan pendidikan terbaik bagi peserta didik.
                </p>
            </div>

            <div class="vision-mission-card" data-aos="fade-up" data-aos-duration="800">
                <div class="vision-icon">
                    <i class="bi bi-bullseye"></i>
                </div>

                <div class="vision-mission-content">
                    <h3>Visi & Misi</h3>

                    @if($profile && $profile->visi_misi)
                        {{-- Mengubah karakter enter/newline menjadi breakline HTML <br> --}}
                        <p>{!! nl2br(e($profile->visi_misi)) !!}</p>
                    @else
                        <p>Visi dan misi sekolah belum tersedia.</p>
                    @endif
                </div>
            </div>

        </div>
    </section>

    {{-- SECTION IDENTITAS SEKOLAH --}}
    <section class="school-identity-section">
        <div class="container">

            <div class="section-heading">
                <span>IDENTITAS</span>
                <h2>Informasi Sekolah</h2>
                <p>Informasi dasar {{ $namaSekolah ?? 'sekolah' }}.</p>
            </div>

            <div class="school-identity-grid">

                {{-- Card Nama Sekolah --}}
                <div class="school-identity-card" data-aos="fade-up" data-aos-duration="800">
                    <i class="bi bi-building"></i>
                    <span>Nama Sekolah</span>
                    <strong>{{ $namaSekolah }}</strong>
                </div>

                {{-- Card NPSN --}}
                <div class="school-identity-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <i class="bi bi-card-text"></i>
                    <span>NPSN</span>
                    <strong>{{ $npsn }}</strong>
                </div>

                {{-- Card Kepala Sekolah --}}
                <div class="school-identity-card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <i class="bi bi-person-badge"></i>
                    <span>Kepala Sekolah</span>
                    <strong>{{ $kepalaSekolah }}</strong>
                </div>

            </div>

        </div>
    </section>

@endsection