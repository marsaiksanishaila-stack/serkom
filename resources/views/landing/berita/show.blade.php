@extends('layouts.landing')

@section('content')

    <section class="news-detail-section">
        <div class="container">
            <div class="news-detail-wrapper">

                <div class="news-breadcrumb">
                    <a href="{{ url('/') }}">Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('berita.index') }}">Berita</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail</span>
                </div>

                <article class="news-detail-card">

                    <div class="news-detail-header">
                        <span class="news-detail-label">BERITA SEKOLAH</span>
                        <h1>{{ $berita->judul }}</h1>

                        <div class="news-detail-meta">
                            <span>
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                            </span>

                            @if($berita->user)
                                <span>
                                    <i class="bi bi-person"></i>
                                    {{ $berita->user->username }}
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($berita->foto)
                        <div class="news-detail-image">
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">
                        </div>
                    @endif

                    <div class="news-detail-content">
                        {!! $berita->isi !!}
                    </div>

                    <div class="achievement-detail-footer">
                        <span>
                            <i class="bi bi-newspaper"></i> Berita {{ $namaSekolah ?? 'sekolah' }}
                        </span>
                    </div>

                </article>

                <div class="news-detail-back">
                    <a href="{{ route('berita.index') }}">
                        <i class="bi bi-arrow-left"></i> Kembali ke Berita
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
