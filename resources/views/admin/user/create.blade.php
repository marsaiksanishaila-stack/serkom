@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <!-- PAGE TITLE -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Tambah User</h3>
        <p class="text-muted mb-0">Tambahkan pengguna baru ke sistem sekolah</p>
    </div>

    <!-- FORM CARD -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                <!-- USERNAME -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Username <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}"
                           placeholder="Masukkan username"
                           required>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- ROLE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Role <span class="text-danger">*</span>
                    </label>
                    <select name="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Role --</option>
                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="Operator" {{ old('role') == 'Operator' ? 'selected' : '' }}>
                            Operator
                        </option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Password <span class="text-danger">*</span>
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimal 6 karakter"
                           required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- ACTION BUTTONS -->
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.user') }}" class="btn btn-secondary px-4">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-save"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
