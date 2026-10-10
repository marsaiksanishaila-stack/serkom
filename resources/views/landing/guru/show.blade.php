{{-- Mengambil master layout dari file layouts/landing.blade.php --}}
@extends('layouts.landing')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

<section class="teacher-detail-page">
    <div class="container">

        {{-- Navigasi Breadcrumb --}}
        <nav class="teacher-breadcrumb" aria-label="breadcrumb">
            <a href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i> Beranda</a>
            <span><i class="bi bi-chevron-right"></i></span>
            <a href="{{ route('guru.index') }}">Staf & Guru</a>
            <span><i class="bi bi-chevron-right"></i></span>
            <span class="active">{{ $guru->nama_guru }}</span>
        </nav>

        {{-- Kartu Detail Guru --}}
        <div class="teacher-detail-card-wrapper" data-aos="fade-up">
            <div class="teacher-detail-layout">

                {{-- Foto Profil Utama Guru --}}
                <div class="teacher-detail-photo">
                    @if($guru->foto)
                        <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}">
                    @else
                        <div class="teacher-detail-placeholder">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    @endif
                </div>

                {{-- Informasi Detail Guru --}}
                <div class="teacher-detail-info">
                    
                    <div class="teacher-header-info">
                        <span class="detail-label">PROFIL TENAGA PENDIDIK</span>
                        <h1>{{ $guru->nama_guru }}</h1>
                        <p class="teacher-subtitle">{{ $guru->mapel ?? 'Tenaga Pendidik' }}</p>
                    </div>

                    {{-- Data Rincian Kepegawaian --}}
                    <div class="teacher-detail-data">
                        <div class="teacher-data-item">
                            <div class="data-icon"><i class="bi bi-briefcase-fill"></i></div>
                            <div class="data-text">
                                <span>Jabatan</span>
                                <strong>Guru / Pengajar</strong>
                            </div>
                        </div>

                        <div class="teacher-data-item">
                            <div class="data-icon"><i class="bi bi-book-half"></i></div>
                            <div class="data-text">
                                <span>Mata Pelajaran</span>
                                <strong>{{ $guru->mapel ?? 'Tenaga Pendidik' }}</strong>
                            </div>
                        </div>

                        <div class="teacher-data-item">
                            <div class="data-icon"><i class="bi bi-card-heading"></i></div>
                            <div class="data-text">
                                <span>NIP / NUPTK</span>
                                <strong>{{ $guru->nip ?? '-' }}</strong>
                            </div>
                        </div>

                        <div class="teacher-data-item">
                            <div class="data-icon"><i class="bi bi-check-circle-fill"></i></div>
                            <div class="data-text">
                                <span>Status Kepegawaian</span>
                                <strong><span class="status-badge">Tenaga Pendidik Aktif</span></strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Daftar Guru Lainnya --}}
        @if(isset($guruLainnya) && $guruLainnya->count())
            <section class="other-teacher-section" data-aos="fade-up">
                <div class="other-teacher-heading">
                    <div>
                        <h2>Staf & Guru Lainnya</h2>
                        <p>Tenaga pendidik dan pengajar profesional lainnya di sekolah kami.</p>
                    </div>

                    <a href="{{ route('guru.index') }}" class="btn-view-all">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="other-teacher-grid">
                    @foreach($guruLainnya as $guruItem)
                        <a href="{{ route('guru.show', $guruItem->encrypted_id ?? $guruItem->id) }}" class="other-teacher-card">
                            <div class="other-teacher-photo">
                                @if($guruItem->foto)
                                    <img src="{{ asset('storage/guru/' . $guruItem->foto) }}" alt="{{ $guruItem->nama_guru }}">
                                @else
                                    <div class="other-teacher-placeholder">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="other-teacher-info">
                                <h3>{{ $guruItem->nama_guru }}</h3>
                                <span>{{ $guruItem->mapel ?? 'Tenaga Pendidik' }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</section>

{{-- Script JS Tambahan untuk Salin Tautan Ke Clipboard --}}
@push('scripts')
<script>
    function copyToClipboard() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = document.getElementById('btnCopyLink');
            const originalHTML = btn.innerHTML;
            
            btn.innerHTML = '<i class="bi bi-check2"></i>';
            btn.style.backgroundColor = '#2E7D32';
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.style.backgroundColor = '';
            }, 2000);
        });
    }
</script>
@endpush

@endsection