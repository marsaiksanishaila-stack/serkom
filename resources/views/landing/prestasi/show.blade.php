{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

    <section class="news-detail-section">
        <div class="container">
            <div class="news-detail-wrapper">

                {{-- Navigasi Breadcrumb --}}
                <div class="news-breadcrumb">
                    <a href="{{ url('/') }}">Beranda</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ route('prestasi.index') }}">Prestasi</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail</span>
                </div>

                {{-- Kartu Detail Prestasi --}}
                <article class="achievement-detail-card">

                    {{-- Header Detail Prestasi --}}
                    <div class="achievement-detail-header">
                        <span class="achievement-detail-label">PRESTASI SEKOLAH</span>
                        <h1>{{ $prestasi->nama_prestasi }}</h1>

                        <div class="achievement-detail-meta">
                            <span>
                                <i class="bi bi-calendar3"></i>
                                Tahun Ajaran {{ $prestasi->tahun_ajaran }}
                            </span>
                        </div>
                    </div>

                    {{-- Foto / Dokumentasi Prestasi --}}
                    @if($prestasi->foto)
                        <div class="achievement-detail-image">
                            <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="{{ $prestasi->nama_prestasi }}">
                        </div>
                    @endif

                    {{-- Deskripsi / Rincian Prestasi Lengkap --}}
                    <div class="achievement-detail-content">
                        {!! nl2br(e($prestasi->deskripsi)) !!}
                    </div>

                    {{-- Footer Kartu --}}
                    <div class="achievement-detail-footer">
                        <span>
                            <i class="bi bi-trophy-fill"></i> Prestasi {{ $namaSekolah ?? 'sekolah' }}
                        </span>
                    </div>

                </article>

                {{-- Tombol Kembali --}}
                <div class="news-detail-back">
                    <a href="{{ route('prestasi.index') }}">
                        <i class="bi bi-arrow-left"></i> Kembali ke Prestasi
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection