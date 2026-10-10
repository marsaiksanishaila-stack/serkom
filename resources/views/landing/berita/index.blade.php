{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' yang ada di master layout --}}
@section('content')

    {{-- SECTION DAFTAR BERITA --}}
    <section class="news-section">
        <div class="container">

            {{-- Judul Halaman / Section --}}
            <div class="section-header">
                <span>BERITA TERKINI</span>
                <h2>Informasi Terbaru</h2>
                <p>Simak berbagai informasi dan kegiatan terbaru dari sekolah.</p>
            </div>

            {{-- Cek apakah ada data berita dari database --}}
            @if($beritas->count())

                <div class="row g-4">
                    {{-- Looping daftar berita --}}
                    @foreach($beritas as $berita)
                        <div class="col-lg-4 col-md-6">
                            {{-- Kartu berita yang mengarah ke halaman detail berita berdasarkan slug --}}
                            <a href="{{ route('berita.show', ['slug' => $berita->slug]) }}"
                               class="news-card d-block text-decoration-none"
                               data-aos="fade-up">

                                {{-- Gambar Berita --}}
                                @if($berita->foto)
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">
                                @else
                                    {{-- Tampilan alternatif jika tidak ada foto --}}
                                    <div class="news-placeholder">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                @endif

                                {{-- Informasi Kartu Berita --}}
                                <div class="news-content">
                                    {{-- Format Tanggal menggunakan Carbon --}}
                                    <small>
                                        <i class="bi bi-calendar3"></i>
                                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                                    </small>

                                    <h3>{{ $berita->judul }}</h3>

                                    {{-- Memotong isi berita maksimal 120 karakter & menghapus tag HTML --}}
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}</p>

                                    <span class="news-read-more">
                                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            @else
                {{-- Tampilan jika belum ada data berita --}}
                <div class="news-empty">
                    <i class="bi bi-newspaper"></i>
                    <h4>Belum Ada Berita</h4>
                    <p>Berita sekolah belum tersedia saat ini.</p>
                </div>
            @endif

        </div>
    </section>

@endsection