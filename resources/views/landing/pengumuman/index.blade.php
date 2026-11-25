@extends('layouts.landing')

@section('content')

    <section class="news-section">
        <div class="container">

            <div class="section-header">
                <span>PENGUMUMAN</span>
                <h2>Informasi Terbaru</h2>
                <p>Simak berbagai pengumuman dan informasi penting dari sekolah.</p>
            </div>

            @if($pengumumans->count())

                <div class="announcement-list">
                    @foreach($pengumumans as $pengumuman)
                        <a href="{{ route('pengumuman.show', $pengumuman->encrypted_id) }}"
                           class="announcement-card"
                           data-aos="fade-up">

                            <div class="announcement-icon">
                                <i class="bi bi-megaphone-fill"></i>
                            </div>

                            <div class="announcement-content">
                                <div class="announcement-meta">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
                                </div>

                                <h3>{{ $pengumuman->judul }}</h3>

                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 150) }}</p>

                                <span class="announcement-read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>

                        </a>
                    @endforeach
                </div>

            @else
                <div class="news-empty">
                    <i class="bi bi-megaphone"></i>
                    <h4>Belum Ada Pengumuman</h4>
                    <p>Pengumuman sekolah belum tersedia saat ini.</p>
                </div>
            @endif

        </div>
    </section>

@endsection