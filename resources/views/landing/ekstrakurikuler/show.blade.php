@extends('layouts.landing')

@section('title', $ekstrakurikuler->nama_ekskul . ' - Ekstrakurikuler')

@section('content')

    <section class="news-detail-section">
        <div class="container">
            <div class="news-detail-wrapper">

                <div class="news-breadcrumb">
                    <a href="{{ url('/') }}">Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('ekstrakurikuler.index') }}">Ekstrakurikuler</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail</span>
                </div>

                <article class="achievement-detail-card">

                    <div class="achievement-detail-header">
                        <span class="achievement-detail-label">EKSTRAKURIKULER SEKOLAH</span>
                        <h1>{{ $ekstrakurikuler->nama_ekskul }}</h1>

                        <div class="achievement-detail-meta" style="display: flex; gap: 20px; flex-wrap: wrap;">
                            @if($ekstrakurikuler->pembina)
                                <span>
                                    <i class="bi bi-person-fill"></i> Pembina: {{ $ekstrakurikuler->pembina }}
                                </span>
                            @endif

                            @if($ekstrakurikuler->jadwal_latihan)
                                <span>
                                    <i class="bi bi-calendar3"></i> Jadwal: {{ $ekstrakurikuler->jadwal_latihan }}
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($ekstrakurikuler->gambar)
                        <div class="achievement-detail-image">
                            <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_ekskul }}">
                        </div>
                    @endif

                    <div class="achievement-detail-content">
                        <h3>Tentang Kegiatan</h3>
                        @if($ekstrakurikuler->deskripsi)
                            {!! nl2br(e($ekstrakurikuler->deskripsi)) !!}
                        @else
                            <p>Deskripsi ekstrakurikuler belum tersedia.</p>
                        @endif
                    </div>

                    <div class="achievement-detail-footer">
                        <span>
                            <i class="bi bi-flag-fill"></i> Ekstrakurikuler {{ $namaSekolah ?? 'sekolah' }}
                        </span>
                    </div>

                </article>

                <div class="news-detail-back">
                    <a href="{{ route('ekstrakurikuler.index') }}">
                        <i class="bi bi-arrow-left"></i> Kembali ke Ekstrakurikuler
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
