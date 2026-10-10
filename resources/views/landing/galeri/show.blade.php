{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

<section class="gallery-detail-section">
    <div class="container">

        {{-- Navigasi Breadcrumb --}}
        <div class="gallery-breadcrumb">
            <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('galeri.index') }}">Galeri</a>
            <i class="bi bi-chevron-right"></i>
            <span>{{ $galeri->judul }}</span>
        </div>

        {{-- Kartu Detail Galeri --}}
        <article class="gallery-detail-card">

            {{-- Header Judul & Meta --}}
            <div class="gallery-detail-header">
                <span class="gallery-detail-category">{{ $galeri->kategori }}</span>
                <h1>{{ $galeri->judul }}</h1>

                <div class="gallery-detail-meta">
                    <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}</span>
                    <span><i class="bi bi-collection"></i> Dokumentasi Sekolah</span>
                </div>
            </div>

            {{-- Media Foto / Player Video --}}
            <div class="gallery-detail-media">
                @if ($galeri->kategori === 'Foto')
                    <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}">
                @else
                    <video controls>
                        <source src="{{ asset('storage/' . $galeri->file) }}">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                @endif
            </div>

            {{-- Keterangan / Deskripsi Dokumentasi --}}
            @if ($galeri->keterangan)
                <div class="gallery-detail-content">
                    <h2>Tentang Dokumentasi</h2>
                    <p>{!! nl2br(e($galeri->keterangan)) !!}</p>
                </div>
            @endif

            {{-- Footer & Tombol Kembali --}}
            <div class="gallery-detail-footer">
                <a href="{{ route('galeri.index') }}" class="gallery-back-button">
                    <i class="bi bi-arrow-left"></i> Kembali ke Galeri
                </a>
            </div>

        </article>

    </div>
</section>

@endsection