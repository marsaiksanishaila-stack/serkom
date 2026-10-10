{{-- Mengambil master layout admin dari file layouts/admin.blade.php --}}
@extends('layouts.admin')

{{-- Mengisi bagian 'content' utama admin --}}
@section('content')

<div class="container-fluid px-3 px-lg-4 py-4">

    {{-- Judul Halaman & Subtitle Keyword Pencarian --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Hasil Pencarian</h3>
        <p class="text-muted mb-0">
            Hasil pencarian untuk: <strong>{{ $keyword }}</strong>
        </p>
    </div>

    {{-- KONDISI 1: Jika kata kunci pencarian kosong --}}
    @if($keyword === '')
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-search fs-1 text-muted"></i>
                <h5 class="fw-bold mt-3">Cari data sekolah</h5>
                <p class="text-muted mb-0">
                    Masukkan nama siswa, guru, berita, galeri,
                    ekstrakurikuler, atau data sekolah.
                </p>
            </div>
        </div>

    {{-- KONDISI 2: Jika kata kunci diisi tapi data tidak ditemukan di DB --}}
    @elseif($results->isEmpty())
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-search fs-1 text-muted"></i>
                <h5 class="fw-bold mt-3">Data tidak ditemukan</h5>
                <p class="text-muted mb-0">
                    Tidak ada data yang cocok dengan "{{ $keyword }}".
                </p>
            </div>
        </div>

    {{-- KONDISI 3: Jika hasil pencarian ditemukan --}}
    @else
        <div class="card border-0 shadow-sm rounded-4">

            {{-- Header Kartu Hasil --}}
            <div class="card-header bg-white border-0 p-3">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-search me-2 text-primary"></i>
                    {{ $results->count() }} hasil ditemukan
                </h5>
            </div>

            {{-- Daftar Hasil Pencarian --}}
            <div class="card-body p-0">
                <div class="list-group list-group-flush">

                    {{-- Loop data hasil pencarian universal --}}
                    @foreach($results as $result)
                        <a href="{{ $result['url'] }}" class="list-group-item list-group-item-action px-4 py-3">
                            <div class="d-flex align-items-center gap-3">

                                {{-- Ikon Kategori Data Dinamis --}}
                                <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                     style="width: 44px; height: 44px; flex-shrink: 0;">
                                    <i class="bi {{ $result['icon'] }} fs-5"></i>
                                </div>

                                {{-- Judul & Deskripsi Singkat Data --}}
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $result['title'] }}</div>
                                    <div class="small text-muted">{{ $result['description'] }}</div>
                                </div>

                                {{-- Label Badge Jenis Data (misal: Siswa, Guru, Berita) --}}
                                <div>
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ $result['type'] }}
                                    </span>
                                </div>

                                {{-- Panah Indikator Navigasi --}}
                                <i class="bi bi-chevron-right text-muted"></i>

                            </div>
                        </a>
                    @endforeach

                </div>
            </div>

        </div>
    @endif

</div>

@endsection