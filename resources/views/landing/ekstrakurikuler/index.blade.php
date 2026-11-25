@extends('layouts.landing')

@section('title', 'Ekstrakurikuler')

@section('content')

<section class="ekskul-page-section">
    <div class="container">

        <div class="section-header">
            <span>KEGIATAN SEKOLAH</span>
            <h2>Ekstrakurikuler</h2>
            <p>
                Berbagai kegiatan ekstrakurikuler untuk mengembangkan
                bakat, minat, dan potensi siswa {{ $namaSekolah ?? 'sekolah' }}.
            </p>
        </div>

        <div class="ekskul-grid">
            @forelse($ekstrakurikulers as $ekstrakurikuler)
                <div class="ekskul-card" data-aos="fade-up">

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

                    <div class="ekskul-content">
                        <h3>{{ $ekstrakurikuler->nama_ekskul }}</h3>

                        @if($ekstrakurikuler->pembina)
                            <div class="ekskul-info">
                                <i class="bi bi-person"></i>
                                <span>{{ $ekstrakurikuler->pembina }}</span>
                            </div>
                        @endif

                        @if($ekstrakurikuler->jadwal_latihan)
                            <div class="ekskul-info">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $ekstrakurikuler->jadwal_latihan }}</span>
                            </div>
                        @endif

                        @if($ekstrakurikuler->deskripsi)
                            <p>{{ Str::limit(strip_tags($ekstrakurikuler->deskripsi), 120) }}</p>
                        @else
                            <p>Informasi ekstrakurikuler belum tersedia.</p>
                        @endif

                        <a href="{{ route('ekstrakurikuler.show', ['slug' => $ekstrakurikuler->slug]) }}" class="ekskul-link">
                            Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                </div>
            @empty
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