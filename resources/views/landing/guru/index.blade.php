@extends('layouts.landing')

@section('content')

    <section class="teacher-section">
        <div class="container">
            
            <div class="section-heading teacher-page-heading">
                <span class="content-label">TENAGA PENDIDIK</span>
                <h2>Guru & Tenaga Pengajar</h2>
                <p>
                    Kenali tenaga pendidik {{ $namaSekolah ?? 'sekolah kami' }}
                    yang siap mendampingi peserta didik.
                </p>
            </div>

            <div class="teacher-grid">
                @forelse($gurus as $index => $guru)
                    <a href="{{ route('guru.show', $guru->encrypted_id) }}" class="teacher-card" data-aos="fade-up"
                        data-aos-duration="800" data-aos-delay="{{ ($index % 5) * 100 }}">
                        
                        <div class="teacher-photo">
                            @if($guru->foto)
                                <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" loading="lazy">
                            @else
                                <div class="teacher-placeholder">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                        </div>

                        <div class="teacher-info">
                            <h3>{{ $guru->nama_guru }}</h3>
                            <span>{{ $guru->mapel ?? 'Tenaga Pendidik' }}</span>
                        </div>
                    </a>
                @empty
                    <div class="teacher-empty" data-aos="fade-up" data-aos-duration="800">
                        <i class="bi bi-person-x"></i>
                        <p>Data guru belum tersedia.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection