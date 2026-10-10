{{-- Mengambil master layout admin dari file layouts/admin.blade.php --}}
@extends('layouts.admin')

{{-- Mengisi bagian 'content' utama --}}
@section('content')

<div class="container-fluid px-4 py-4">

    <div class="card shadow-sm border-0">

        {{-- Header Kartu --}}
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-circle me-2"></i> Profil Admin
            </h5>
        </div>

        <div class="card-body">

            {{-- Alert Notifikasi Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Notifikasi Error Validasi --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Inisial Avatar & Identitas Pengguna --}}
            <div class="text-center mb-4">
                {{-- Lingkaran Avatar yang Mengambil 2 Huruf Pertama Username --}}
                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3 shadow-sm"
                     style="width: 90px; height: 90px; font-size: 35px;">
                    {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 2)) }}
                </div>

                <h4 class="mb-1 fw-bold">
                    {{ auth()->user()->username ?? '-' }}
                </h4>

                <span class="badge bg-success">
                    {{ auth()->user()->role ?? '-' }}
                </span>
            </div>

            <hr>

            {{-- Form Edit Username & Password --}}
            <form action="{{ route('admin.user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Input Username --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 fw-bold form-label">Username</label>
                    <div class="col-md-9">
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ old('username', auth()->user()->username) }}"
                               required>
                    </div>
                </div>

                {{-- Display Role (Readonly) --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 fw-bold form-label">Role</label>
                    <div class="col-md-9">
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ auth()->user()->role }}"
                               readonly>
                    </div>
                </div>

                <hr>

                {{-- Subheader Ubah Password --}}
                <h6 class="fw-bold mb-3 text-primary">
                    <i class="fas fa-lock me-2"></i> Ubah Password
                </h6>

                {{-- Input Password Baru --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 fw-bold form-label">Password Baru</label>
                    <div class="col-md-9">
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                </div>

                {{-- Input Konfirmasi Password --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-md-3 fw-bold form-label">Konfirmasi Password</label>
                    <div class="col-md-9">
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password baru">
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection