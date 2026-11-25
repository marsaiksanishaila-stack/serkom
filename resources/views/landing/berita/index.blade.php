@extends('layouts.landing')

@section('content')

    <section class="news-section">
        <div class="container">
            <div class="section-header">
                <span>BERITA TERKINI</span>
                <h2>Informasi Terbaru</h2>
                <p>Simak berbagai informasi dan kegiatan terbaru dari sekolah.</p>
            </div>

            @if($beritas->count())

                <div class="row g-4">
                    @foreach($beritas as $berita)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('berita.show', ['slug' => $berita->slug]) }}"
                               class="news-card d-block text-decoration-none"
                               data-aos="fade-up">
                                @if($berita->foto)
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">
                                @else
                                    <div class="news-placeholder">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                @endif

                                <div class="news-content">
                                    <small>
                                        <i class="bi bi-calendar3"></i>
                                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                                    </small>

                                    <h3>{{ $berita->judul }}</h3>
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
                <div class="news-empty">
                    <i class="bi bi-newspaper"></i>
                    <h4>Belum Ada Berita</h4>
                    <p>Berita sekolah belum tersedia saat ini.</p>
                </div>
            @endif

        </div>
    </section>

@endsection