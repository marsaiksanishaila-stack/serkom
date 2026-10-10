{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengatur title halaman sesuai nama ekskul --}}
@section('title', $ekstrakurikuler->nama_ekskul . ' - Ekstrakurikuler')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

    <section class="news-detail-section">
        <div class="container">
            <div class="news-detail-wrapper">

                {{-- Navigasi Breadcrumb --}}
                <div class="news-breadcrumb">
                    <a href="{{ url('/') }}">Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('ekstrakurikuler.index') }}">Ekstrakurikuler</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail</span>
                </div>

                {{-- Kartu Detail Ekskul --}}
                <article class="achievement-detail-card">

                    {{-- Header Detail Ekskul --}}
                    <div class="achievement-detail-header">
                        <span class="achievement-detail-label">EKSTRAKURIKULER SEKOLAH</span>
                        <h1>{{ $ekstrakurikuler->nama_ekskul }}</h1>

                        {{-- Metadata Pembina & Jadwal --}}
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

                    {{-- Foto Kegiatan Ekskul --}}
                    @if($ekstrakurikuler->gambar)
                        <div class="achievement-detail-image">
                            <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_ekskul }}">
                        </div>
                    @endif

                    {{-- Konten Deskripsi Lengkap --}}
                    <div class="achievement-detail-content">
                        <h3>Tentang Kegiatan</h3>
                        @if($ekstrakurikuler->deskripsi)
                            {{-- Mengubah enter/newline menjadi tag <br> secara aman --}}
                            {!! nl2br(e($ekstrakurikuler->deskripsi)) !!}
                        @else
                            <p>Deskripsi ekstrakurikuler belum tersedia.</p>
                        @endif
                    </div>

                    {{-- Footer Kartu --}}
                    <div class="achievement-detail-footer">
                        <span>
                            <i class="bi bi-stars"></i> Ekstrakurikuler {{ $namaSekolah ?? 'sekolah' }}
                        </span>
                    </div>

                </article>

                {{-- Tombol Kembali --}}
                <div class="news-detail-back">
                    <a href="{{ route('ekstrakurikuler.index') }}">
                        <i class="bi bi-arrow-left"></i> Kembali ke Ekstrakurikuler
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection