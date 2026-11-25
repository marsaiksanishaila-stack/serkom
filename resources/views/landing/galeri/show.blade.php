@extends('layouts.landing')

@section('content')
    <section class="gallery-detail-section">
        <div class="container">

            <div class="gallery-breadcrumb">
                <a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('galeri.index') }}">Galeri</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ $galeri->judul }}</span>
            </div>

            <article class="gallery-detail-card">

                <div class="gallery-detail-header">
                    <span class="gallery-detail-category">{{ $galeri->kategori }}</span>
                    <h1>{{ $galeri->judul }}</h1>

                    <div class="gallery-detail-meta">
                        <span><i class="bi bi-calendar3"></i>
                            {{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}</span>
                        <span><i class="bi bi-collection"></i> Dokumentasi Sekolah</span>
                    </div>
                </div>

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

                @if ($galeri->keterangan)
                    <div class="gallery-detail-content">
                        <h2>Tentang Dokumentasi</h2>
                        <p>{!! nl2br(e($galeri->keterangan)) !!}</p>
                    </div>
                @endif

                <div class="achievement-detail-footer">
                    <span>
                        <i class="bi bi-images"></i> Galeri {{ $namaSekolah ?? 'sekolah' }}
                    </span>
                </div>

            </article>

            <div class="gallery-detail-footer">
                <a href="{{ route('galeri.index') }}" class="gallery-back-button">
                    <i class="bi bi-arrow-left"></i> Kembali ke Galeri
                </a>
            </div>
            
        </div>
    </section>
@endsection
