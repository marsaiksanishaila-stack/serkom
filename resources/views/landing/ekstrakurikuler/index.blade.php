{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengatur title halaman dinamis --}}
@section('title', 'Ekstrakurikuler')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

<section class="ekskul-page-section">
    <div class="container">

        {{-- Header Section --}}
        <div class="section-header">
            <span>KEGIATAN SEKOLAH</span>
            <h2>Ekstrakurikuler</h2>
            <p>
                Berbagai kegiatan ekstrakurikuler untuk mengembangkan
                bakat, minat, dan potensi siswa {{ $namaSekolah ?? 'sekolah' }}.
            </p>
        </div>

        {{-- Grid Daftar Ekstrakurikuler --}}
        <div class="ekskul-grid">
            {{-- Perulangan data ekskul, jika kosong lari ke @empty --}}
            @forelse($ekstrakurikulers as $ekstrakurikuler)
                <div class="ekskul-card" data-aos="fade-up">

                    {{-- Gambar / Placeholder Ekskul --}}
                    <div class="ekskul-image">
                        @if($ekstrakurikuler->gambar)
                            <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                                 alt="{{ $ekstrakurikuler->nama_ekskul }}"
                                 loading="lazy">
                        @else
                            <div class="ekskul-placeholder">
                                <i class="bi bi-stars"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Informasi Singkat Ekskul --}}
                    <div class="ekskul-content">
                        <h3>{{ $ekstrakurikuler->nama_ekskul }}</h3>

                        {{-- Nama Pembina --}}
                        @if($ekstrakurikuler->pembina)
                            <div class="ekskul-info">
                                <i class="bi bi-person"></i>
                                <span>{{ $ekstrakurikuler->pembina }}</span>
                            </div>
                        @endif

                        {{-- Jadwal Latihan --}}
                        @if($ekstrakurikuler->jadwal_latihan)
                            <div class="ekskul-info">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $ekstrakurikuler->jadwal_latihan }}</span>
                            </div>
                        @endif

                        {{-- Cuplikan Deskripsi (Dipotong max 120 karakter) --}}
                        @if($ekstrakurikuler->deskripsi)
                            <p>{{ Str::limit(strip_tags($ekstrakurikuler->deskripsi), 120) }}</p>
                        @else
                            <p>Informasi ekstrakurikuler belum tersedia.</p>
                        @endif

                        {{-- Link ke Detail Ekskul berdasarkan Slug --}}
                        <a href="{{ route('ekstrakurikuler.show', ['slug' => $ekstrakurikuler->slug]) }}" class="ekskul-link">
                            Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                </div>
            @empty
                {{-- Tampilan jika data ekskul masih kosong --}}
                <div class="empty-box">
                    <i class="bi bi-stars"></i>
                    <h4>Belum Ada Ekstrakurikuler</h4>
                    <p>Data ekstrakurikuler belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection