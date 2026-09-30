@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

<div class="card shadow-sm border-0">

    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="fas fa-user-circle me-2"></i>
            Profil Admin
        </h5>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="text-center mb-4">

            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                 style="width: 90px; height: 90px; font-size: 35px;">
                {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 2)) }}
            </div>

            <h4 class="mb-1">
                {{ auth()->user()->username ?? '-' }}
            </h4>

            <span class="badge bg-success">
                {{ auth()->user()->role ?? '-' }}
            </span>

        </div>

        <hr>

        <form action="{{ route('admin.profile.update') }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label class="col-md-3 fw-bold">
                    Username
                </label>

                <div class="col-md-9">
                    <input type="text"
                           name="username"
                           class="form-control"
                           value="{{ old('username', auth()->user()->username) }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 fw-bold">
                    Role
                </label>

                <div class="col-md-9">
                    <input type="text"
                           class="form-control"
                           value="{{ auth()->user()->role }}"
                           readonly>
                </div>
            </div>

            <hr>

            <h6 class="fw-bold mb-3">
                <i class="fas fa-lock me-2"></i>
                Ubah Password
            </h6>

            <div class="row mb-3">
                <label class="col-md-3 fw-bold">
                    Password Baru
                </label>

                <div class="col-md-9">
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 fw-bold">
                    Konfirmasi Password
                </label>

                <div class="col-md-9">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password baru">
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="{{ route('admin.dashboard') }}"
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
</div>

</div>

@endsection
