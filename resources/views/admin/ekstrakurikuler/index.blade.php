@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Ekstrakurikuler</h3>
                <p class="text-muted mb-0">Kelola kegiatan ekstrakurikuler sekolah</p>
            </div>

            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Ekstrakurikuler
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
                                <th>Gambar</th>
                                <th>Nama Ekstrakurikuler</th>
                                <th>Pembina</th>
                                <th>Jadwal Latihan</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ekstrakurikulers as $ekskul)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($ekskul->gambar)
                                            <img src="{{ asset('storage/' . $ekskul->gambar) }}" width="100"
                                                height="70" style="object-fit: cover; border-radius: 8px;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $ekskul->nama_ekskul }}</strong>
                                    </td>
                                    <td>{{ $ekskul->pembina }}</td>
                                    <td>{{ $ekskul->jadwal_latihan }}</td>
                                    <td>
                                        {{ Str::limit($ekskul->deskripsi, 60) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.ekstrakurikuler.edit', $ekskul->id_ekskul) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.ekstrakurikuler.destroy', $ekskul->id_ekskul) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus ekstrakurikuler ini?')">
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
                                    <td colspan="7" class="text-center py-4">
                                        Belum ada data ekstrakurikuler.
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
