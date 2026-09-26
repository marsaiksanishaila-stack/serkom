@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold">Galeri</h3>
                <p class="text-muted mb-0">Kelola foto dan video sekolah</p>
            </div>

            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Galeri
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
                                <th>File</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($galeris as $galeri)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if ($galeri->file)
                                            @if ($galeri->kategori == 'Foto')
                                                <img src="{{ asset('storage/' . $galeri->file) }}" width="100"
                                                    height="65" style="object-fit: cover; border-radius: 8px;">
                                            @else
                                                <video width="120" height="70" controls>
                                                    <source src="{{ asset('storage/' . $galeri->file) }}">
                                                </video>
                                            @endif
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>{{ $galeri->judul }}</strong>

                                        @if ($galeri->keterangan)
                                            <br>
                                            <small class="text-muted">
                                                {{ Str::limit($galeri->keterangan, 50) }}
                                            </small>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $galeri->kategori }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d-m-Y') }}
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.galeri.edit', $galeri->id_galeri) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.galeri.destroy', $galeri->id_galeri) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">

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
                                        Belum ada data galeri.
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
