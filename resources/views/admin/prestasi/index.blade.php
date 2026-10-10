@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        {{-- Header Halaman & Tombol Tambah Prestasi --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Prestasi</h3>
                <p class="text-muted mb-0">Kelola prestasi sekolah</p>
            </div>

            {{-- Tombol untuk mengarahkan ke form tambah prestasi --}}
            <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Prestasi
            </a>
        </div>

        {{-- Alert Notifikasi Sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                {{-- Form Pencarian Prestasi --}}
                <div class="mb-3" style="max-width: 400px;">
                    <form action="{{ route('admin.prestasi') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari prestasi..." value="{{ request('search') }}">

                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>

                            {{-- Tombol reset pencarian, muncul jika sedang melakukan pencarian --}}
                            @if(request('search'))
                                <a href="{{ route('admin.prestasi') }}" class="btn btn-secondary">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- TABEL DATA PRESTASI --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Prestasi</th>
                                <th>Deskripsi</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Looping daftar prestasi dari controller --}}
                            @forelse($prestasis as $prestasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    {{-- Thumbnail Foto Prestasi --}}
                                    <td>
                                        @if($prestasi->foto)
                                            <img src="{{ asset('storage/' . $prestasi->foto) }}" width="100" height="70" style="object-fit: cover; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>{{ $prestasi->nama_prestasi }}</strong>
                                    </td>

                                    {{-- Potong deskripsi maksimal 70 karakter agar tabel tetap rapi --}}
                                    <td>
                                        {{ Str::limit($prestasi->deskripsi, 70) }}
                                    </td>

                                    <td>
                                        {{ $prestasi->tahun_ajaran }}
                                    </td>

                                    {{-- Group Tombol Aksi (Edit & Hapus) --}}
                                    <td>
                                        <a href="{{ route('admin.prestasi.edit', $prestasi->encrypted_id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.prestasi.destroy', $prestasi->encrypted_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                {{-- Kondisi jika data kosong atau hasil pencarian tidak ditemukan --}}
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        @if(request('search'))
                                            Data prestasi dengan pencarian "<strong>{{ request('search') }}</strong>" tidak ditemukan.
                                        @else
                                            Belum ada data prestasi.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

@endsection