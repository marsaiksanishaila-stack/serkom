@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1">
                Kelola Data Guru
            </h3>
            <p class="text-muted mb-0">
                Manajemen data tenaga pendidik dan staf pengajar sekolah.
            </p>
        </div>

        @if(Auth::user()->role == 'Admin')
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary px-3 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Guru
            </a>
        @endif
    </div>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- ALERT ERROR -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- VALIDATION ERROR -->
    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- SEARCH -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.guru.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama guru, NIP, atau mapel...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th>Foto</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Mata Pelajaran</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $guru)
                            <tr>
                                <!-- NO -->
                                <td class="px-4">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- FOTO -->
                                <td>
                                    @if($guru->foto)
                                        <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" style="width:55px; height:55px; object-fit:cover; border-radius:50%;">
                                    @else
                                        <div class="bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width:55px; height:55px; border-radius:50%;">
                                            <i class="bi bi-person-fill fs-5"></i>
                                        </div>
                                    @endif
                                </td>

                                <!-- NAMA -->
                                <td>
                                    <span class="fw-semibold">
                                        {{ $guru->nama_guru }}
                                    </span>
                                </td>

                                <!-- NIP -->
                                <td>
                                    {{ $guru->nip ?? '-' }}
                                </td>

                                <!-- MAPEL -->
                                <td>
                                    @if($guru->mapel)
                                        <span class="badge bg-info-subtle text-info">
                                            {{ $guru->mapel }}
                                        </span>
                                    @else
                                        <span class="text-muted">
                                            Belum Diatur
                                        </span>
                                    @endif
                                </td>

                                <!-- AKSI -->
                                <td class="text-center">
                                    @if(Auth::user()->role == 'Admin')
                                        <div class="btn-group btn-group-sm">
                                            <!-- EDIT -->
                                            <a href="{{ route('admin.guru.edit', $guru->id_guru) }}" class="btn btn-outline-warning" title="Edit Data">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- HAPUS -->
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusGuru{{ $guru->id_guru }}" title="Hapus Data">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>

                            <!-- MODAL HAPUS -->
                            @if(Auth::user()->role == 'Admin')
                                <div class="modal fade" id="modalHapusGuru{{ $guru->id_guru }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4">
                                            <form action="{{ route('admin.guru.destroy', $guru->id_guru) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-bold">
                                                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                                                        Hapus Data Guru
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p class="mb-2">
                                                        Apakah kamu yakin ingin menghapus data guru:
                                                    </p>
                                                    <div class="alert alert-light border rounded-3">
                                                        <strong>
                                                            {{ $guru->nama_guru }}
                                                        </strong>
                                                        <br>
                                                        <small class="text-muted">
                                                            NIP: {{ $guru->nip ?? '-' }}
                                                        </small>
                                                    </div>
                                                    <p class="text-danger small mb-0">
                                                        Data yang sudah dihapus tidak dapat dikembalikan.
                                                    </p>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash me-1"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-person-x fs-1 d-block mb-3"></i>
                                        <h6 class="fw-bold">
                                            Data guru belum tersedia
                                        </h6>
                                        <p class="mb-0">
                                            @if(request('search'))
                                                Data guru tidak ditemukan.
                                            @else
                                                Belum ada data guru yang tersimpan.
                                            @endif
                                        </p>
                                    </div>
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