@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">

    <!-- PAGE TITLE & ACTION -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1">Kelola User</h3>
            <p class="text-muted mb-0">Kelola data pengguna sistem sekolah</p>
        </div>

        @if(Auth::user()->role == 'Admin')
            <a href="{{ route('admin.user.create') }}"
               class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah User</span>
            </a>
        @endif
    </div>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- ALERT ERROR -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3" style="width: 60px;">No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th style="width: 180px;">Tanggal Dibuat</th>
                            <th class="text-end pe-3" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="ps-3 fw-medium text-muted">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width: 38px; height: 38px;">
                                            <i class="bi bi-person-fill fs-5"></i>
                                        </div>
                                        <span class="fw-semibold text-dark">
                                            {{ $user->username }}
                                        </span>
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

                                <!-- AKSI -->
                                <td class="text-end pe-3">
                                    @if(Auth::user()->role == 'Admin')
                                        <div class="btn-group btn-group-sm">
                                            <!-- EDIT -->
                                            <a href="{{ route('admin.user.edit', $user->id_user) }}"
                                               class="btn btn-outline-warning"
                                               title="Edit User">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- HAPUS -->
                                            <form action="{{ route('admin.user.destroy', $user->id_user) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-outline-danger"
                                                        title="Hapus User">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-person-x display-6 d-block mb-2"></i>
                                    <span>Belum ada data user tersimpan.</span>
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