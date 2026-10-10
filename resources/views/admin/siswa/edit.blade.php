@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Edit Data Siswa</h3>
        <p class="text-muted mb-0">Perbarui data siswa.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3 mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.siswa.update', $siswa->encrypted_id ?? $siswa->id_siswa) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NISN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">NISN <span class="text-danger">*</span></label>
                    <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" maxlength="10" value="{{ old('nisn', $siswa->nisn) }}" required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Siswa --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Siswa <span class="text-danger">*</span></label>
                    <input type="text" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" maxlength="40" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                    @error('nama_siswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="Laki-Laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun Masuk --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tahun Masuk <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_masuk" class="form-control @error('tahun_masuk') is-invalid @enderror" value="{{ old('tahun_masuk', $siswa->tahun_masuk) }}" required>
                    @error('tahun_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary px-4">Kembali</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection