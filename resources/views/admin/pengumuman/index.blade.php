@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Pengumuman</h3>
        <p class="text-muted mb-0">Kelola pengumuman sekolah</p>
    </div>

<a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-lg"></i> Tambah Pengumuman
</a>


</div>

@if(session('success')) <div class="alert alert-success">
{{ session('success') }} </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

    <form action="{{ route('admin.pengumuman') }}" method="GET" class="mb-4">
        <div class="input-group" style="max-width: 400px;">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari judul, isi, atau status..."
                   value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>

            @if(request('search'))
                <a href="{{ route('admin.pengumuman') }}"
                   class="btn btn-secondary">
                    Reset
                </a>
            @endif

        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pengumumans as $pengumuman)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $pengumuman->judul }}</strong>
                        </td>

                        <td>
                            {{ Str::limit($pengumuman->isi, 70) }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d-m-Y') }}
                        </td>

                        <td>
                            @if($pengumuman->status == 'Publish')
                                <span class="badge bg-success">
                                    Publish
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Draft
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.pengumuman.edit', $pengumuman->id_pengumuman) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id_pengumuman) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">

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

                            @if(request('search'))
                                Data pengumuman dengan pencarian
                                "<strong>{{ request('search') }}</strong>"
                                tidak ditemukan.
                            @else
                                Belum ada data pengumuman.
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
