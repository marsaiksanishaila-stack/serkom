@extends('layouts.admin')
@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Data Berita</h3>
                <p class="text-muted mb-0">Kelola berita sekolah</p>
            </div>

            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Berita
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beritas as $berita)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($berita->foto)
                                            <img src="{{ asset('storage/' . $berita->foto) }}" width="80" height="55"
                                                style="object-fit: cover; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $berita->judul }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ Str::limit($berita->isi, 60) }}
                                        </small>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($berita->tanggal)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        {{ $berita->user->username ?? '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.berita.edit', $berita->id_berita) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $berita->id_berita) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Belum ada data berita.
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
