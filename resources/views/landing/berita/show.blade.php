{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' yang ada di master layout --}}
@section('content')

    {{-- SECTION DETAIL BERITA --}}
    <section class="news-detail-section">
        <div class="container">
            <div class="news-detail-wrapper">

                {{-- Breadcrumb Navigasi --}}
                <div class="news-breadcrumb">
                    <a href="{{ url('/') }}">Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('berita.index') }}">Berita</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail</span>
                </div>

                {{-- Container Utama Artikel --}}
                <article class="news-detail-card">

                    {{-- Header Judul & Metadata Berita --}}
                    <div class="news-detail-header">
                        <span class="news-detail-label">BERITA SEKOLAH</span>
                        <h1>{{ $berita->judul }}</h1>

                        <div class="news-detail-meta">
                            {{-- Tanggal Rilis --}}
                            <span>
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                            </span>

                            {{-- Pembuat/Penulis Berita (Author) --}}
                            @if($berita->user)
                                <span>
                                    <i class="bi bi-person"></i>
                                    {{ $berita->user->username }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Foto Utama Berita --}}
                    @if($berita->foto)
                        <div class="news-detail-image">
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">
                        </div>
                    @endif

                    {{-- Isi Artikel Lengkap (Mendukung Format HTML/WYSIWYG Editor) --}}
                    <div class="news-detail-content">
                        {!! $berita->isi !!}
                    </div>

                    {{-- Tombol Bagikan ke Media Sosial --}}
                    <div class="news-detail-share">
                        <span>Bagikan:</span>

                        {{-- Facebook Share --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                           target="_blank" class="share-facebook" title="Bagikan ke Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>

                        {{-- Twitter/X Share --}}
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}"
                           target="_blank" class="share-x" title="Bagikan ke X">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        {{-- WhatsApp Share --}}
                        <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->fullUrl()) }}"
                           target="_blank" class="share-whatsapp" title="Bagikan ke WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>

                </article>

                {{-- Tombol Kembali ke Halaman Indeks Berita --}}
                <div class="news-detail-back">
                    <a href="{{ route('berita.index') }}">
                        <i class="bi bi-arrow-left"></i> Kembali ke Berita
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection