@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1">Kelola User</h3>
            <p class="text-muted mb-0">Kelola data pengguna sistem sekolah</p>
        </div>

        @if(Auth::user()->role == 'Admin')
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary px-3 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah User
            </a>
        @endif
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- SEARCH FORM --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.user.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Cari username atau role...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="px-4">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px;">
                                            <i class="bi bi-person-fill fs-5"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $user->username }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($user->role == 'Admin')
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">
                                            Operator
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                                </td>
                                <td class="text-center">
                                    @if(Auth::user()->role == 'Admin')
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.user.edit', $user->encrypted_id ?? $user->id_user) }}" class="btn btn-outline-warning" title="Edit User">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusUser{{ $user->id_user }}" title="Hapus User">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-person-x fs-1 d-block mb-3"></i>
                                        <h6 class="fw-bold">Data user belum tersedia</h6>
                                        <p class="mb-0">
                                            @if(request('search'))
                                                Data user dengan pencarian "<strong>{{ request('search') }}</strong>" tidak ditemukan.
                                            @else
                                                Belum ada data user yang tersimpan.
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

{{-- MODAL HAPUS USER (Ditempatkan di luar tabel agar struktur DOM valid) --}}
@if(Auth::user()->role == 'Admin')
    @foreach($users as $user)
        <div class="modal fade" id="modalHapusUser{{ $user->id_user }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">
                    <form action="{{ route('admin.user.destroy', $user->encrypted_id ?? $user->id_user) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-bold">
                                <i class="bi bi-exclamation-triangle text-danger me-2"></i> Hapus User
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <p class="mb-2">Apakah kamu yakin ingin menghapus user:</p>
                            <div class="alert alert-light border rounded-3">
                                <strong>{{ $user->username }}</strong><br>
                                <small class="text-muted">Role: {{ $user->role }}</small>
                            </div>
                            <p class="text-danger small mb-0">Data yang sudah dihapus tidak dapat dikembalikan.</p>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection