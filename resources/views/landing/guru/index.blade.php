{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

    <section class="teacher-section">
        <div class="container">
            
            {{-- Header Section --}}
            <div class="section-heading teacher-page-heading">
                <span class="content-label">TENAGA PENDIDIK</span>
                <h2>Guru & Tenaga Pengajar</h2>
                <p>
                    Kenali tenaga pendidik {{ $namaSekolah ?? 'sekolah kami' }}
                    yang siap mendampingi peserta didik.
                </p>
            </div>

            {{-- Grid Daftar Guru --}}
            <div class="teacher-grid">
                {{-- Perulangan data guru ($index digunakan untuk delay animasi AOS) --}}
                @forelse($gurus as $index => $guru)
                    <a href="{{ route('guru.show', $guru->encrypted_id) }}" class="teacher-card" data-aos="fade-up"
                        data-aos-duration="800" data-aos-delay="{{ ($index % 5) * 100 }}">
                        
                        {{-- Foto Profil Guru --}}
                        <div class="teacher-photo">
                            @if($guru->foto)
                                <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" loading="lazy">
                            @else
                                <div class="teacher-placeholder">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Nama & Mata Pelajaran --}}
                        <div class="teacher-info">
                            <h3>{{ $guru->nama_guru }}</h3>
                            <span>{{ $guru->mapel ?? 'Tenaga Pendidik' }}</span>
                        </div>
                    </a>
                @empty
                    {{-- Tampilan jika data guru belum tersedia --}}
                    <div class="teacher-empty" data-aos="fade-up" data-aos-duration="800">
                        <i class="bi bi-person-x"></i>
                        <p>Data guru belum tersedia.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection