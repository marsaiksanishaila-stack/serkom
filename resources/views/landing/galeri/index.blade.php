{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

<section class="gallery-page-section">
    <div class="container">

        {{-- Header Section --}}
        <div class="section-heading">
            <span class="content-label">DOKUMENTASI SEKOLAH</span>
            <h2>Galeri Sekolah</h2>
            <p>Dokumentasi berbagai kegiatan dan momen di SMK YPC Tasikmalaya.</p>
        </div>

        {{-- Grid Daftar Galeri --}}
        <div class="gallery-page-grid">
            {{-- Perulangan data galeri ($index digunakan untuk delay animasi AOS) --}}
            @forelse ($galeris as $index => $galeri)

                {{-- Card Galeri mengarah ke route detail berdasar slug --}}
                <a href="{{ route('galeri.show', ['slug'=> $galeri->slug]) }}"
                   class="gallery-page-card"
                   data-aos="fade-up"
                   data-aos-duration="800"
                   data-aos-delay="{{ ($index % 3) * 100 }}">

                    <div class="gallery-page-image">
                        {{-- Pengecekan Kategori Foto vs Video --}}
                        @if ($galeri->kategori === 'Foto')
                            @if ($galeri->file)
                                <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}" loading="lazy">
                            @else
                                <div class="gallery-page-placeholder"><i class="bi bi-image"></i></div>
                            @endif
                        @else
                            {{-- Preview Video Singkat --}}
                            <div class="gallery-page-video">
                                <video muted preload="metadata">
                                    <source src="{{ asset('storage/' . $galeri->file) }}">
                                </video>
                                <span class="gallery-video-icon"><i class="bi bi-play-fill"></i></span>
                            </div>
                        @endif

                        {{-- Hover Overlay Kartu Galeri --}}
                        <div class="gallery-page-overlay">
                            <span class="gallery-page-category">{{ $galeri->kategori }}</span>
                            <h3>{{ $galeri->judul }}</h3>
                            <span class="gallery-page-detail">Lihat detail <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>

                    {{-- Informasi Singkat Bawah Kartu --}}
                    <div class="gallery-page-info">
                        <div class="gallery-page-meta">
                            <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}</span>
                            <span><i class="bi bi-collection"></i> {{ $galeri->kategori }}</span>
                        </div>
                        <h3>{{ $galeri->judul }}</h3>

                        @if ($galeri->keterangan)
                            <p>{{ Str::limit($galeri->keterangan, 100) }}</p>
                        @endif
                    </div>

                </a>

            @empty
                {{-- Tampilan jika data galeri kosong --}}
                <div class="gallery-page-empty" data-aos="fade-up" data-aos-duration="800">
                    <div class="gallery-empty-icon"><i class="bi bi-images"></i></div>
                    <h3>Belum Ada Galeri</h3>
                    <p>Dokumentasi kegiatan sekolah belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection