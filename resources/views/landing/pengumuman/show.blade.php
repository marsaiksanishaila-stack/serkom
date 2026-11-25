@extends('layouts.landing')

@section('content')

    <section class="news-detail-section">
        <div class="container">
            <div class="news-detail-wrapper">

                <div class="news-breadcrumb">
                    <a href="{{ url('/') }}">Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('pengumuman.index') }}">Pengumuman</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail</span>
                </div>

                <article class="announcement-detail-card">

                    <div class="announcement-detail-header">
                        <span class="announcement-detail-label">PENGUMUMAN SEKOLAH</span>
                        <h1>{{ $pengumuman->judul }}</h1>

                        <div class="announcement-detail-meta">
                            <span>
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="announcement-detail-content">
                        {!! $pengumuman->isi !!}
                    </div>

                    <div class="announcement-detail-footer">
                        <span>
                            <i class="bi bi-info-circle"></i> Pengumuman resmi sekolah
                        </span>
                    </div>

                </article>

                <div class="news-detail-back">
                    <a href="{{ route('pengumuman.index') }}">
                        <i class="bi bi-arrow-left"></i> Kembali ke Pengumuman
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection