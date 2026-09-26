@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Prestasi</h3>
            <p class="text-muted mb-0">Kelola prestasi sekolah</p>
        </div>

        <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Prestasi
        </a>
    </div>

    @if(session('success'))
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
                            <th>Nama Prestasi</th>
                            <th>Deskripsi</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($prestasis as $prestasi)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    @if($prestasi->foto)
                                        <img src="{{ asset('storage/' . $prestasi->foto) }}"
                                             width="100"
                                             height="70"
                                             style="object-fit: cover; border-radius: 8px;">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $prestasi->nama_prestasi }}</strong>
                                </td>

                                <td>
                                    {{ Str::limit($prestasi->deskripsi, 70) }}
                                </td>

                                <td>
                                    {{ $prestasi->tahun_ajaran }}
                                </td>

                                <td>
                                    <a href="{{ route('admin.prestasi.edit', $prestasi->id_prestasi) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.prestasi.destroy', $prestasi->id_prestasi) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Belum ada data prestasi.
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
