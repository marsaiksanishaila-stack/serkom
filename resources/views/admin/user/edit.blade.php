@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <!-- PAGE TITLE -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Edit User</h3>
        <p class="text-muted mb-0">Ubah informasi data pengguna sistem</p>
    </div>

    <!-- FORM CARD -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.user.update', $user->id_user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- USERNAME -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Username <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username', $user->username) }}"
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
                        <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                        <option value="Operator" {{ old('role', $user->role) == 'Operator' ? 'selected' : '' }}>
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
                    <label class="form-label fw-semibold">Password Baru</label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                    <small class="text-muted d-block mt-1">
                        Biarkan opsi ini kosong jika password tidak ingin diperbarui.
                    </small>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- ACTION BUTTONS -->
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary px-4">
                        Kembali
                    </a>        
                    <button type="submit" class="btn btn-primary px-4 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-save"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
