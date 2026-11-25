@extends('layouts.landing')

@section('title', 'Prestasi Sekolah')

@section('content')

<section class="ekskul-page-section">
    <div class="container">

        <div class="section-header">
            <span>PENCAPAIAN SEKOLAH</span>
            <h2>Prestasi Sekolah</h2>
            <p>
                Berbagai pencapaian dan prestasi yang berhasil diraih
                oleh siswa dan {{ $namaSekolah ?? 'sekolah kami' }}.
            </p>
        </div>

        <div class="ekskul-grid">
            @forelse($prestasis as $prestasi)
                <div class="ekskul-card" data-aos="fade-up">

                    <div class="ekskul-image">
                        @if($prestasi->foto)
                            <img src="{{ asset('storage/' . $prestasi->foto) }}"
                                 alt="{{ $prestasi->nama_prestasi }}"
                                 loading="lazy">
                        @else
                            <div class="ekskul-placeholder">
                                <i class="bi bi-trophy"></i>
                            </div>
                        @endif
                    </div>

                    <div class="ekskul-content">
                        <h3>{{ $prestasi->nama_prestasi }}</h3>

                        @if($prestasi->tahun_ajaran)
                            <div class="ekskul-info">
                                <i class="bi bi-calendar3"></i>
                                <span>Tahun Ajaran {{ $prestasi->tahun_ajaran }}</span>
                            </div>
                        @endif

                        @if($prestasi->tingkat)
                            <div class="ekskul-info">
                                <i class="bi bi-award"></i>
                                <span>Tingkat {{ $prestasi->tingkat }}</span>
                            </div>
                        @endif

                        @if($prestasi->deskripsi)
                            <p>{{ Str::limit(strip_tags($prestasi->deskripsi), 120) }}</p>
                        @else
                            <p>Informasi prestasi belum tersedia.</p>
                        @endif

                        <a href="{{ route('prestasi.show', ['slug'=> $prestasi->slug]) }}" class="ekskul-link">
                            Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                </div>
            @empty
                <div class="empty-box">
                    <i class="bi bi-trophy"></i>
                    <h4>Belum Ada Prestasi</h4>
                    <p>Data prestasi sekolah belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection