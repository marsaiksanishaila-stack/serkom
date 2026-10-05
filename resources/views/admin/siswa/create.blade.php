@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Tambah Siswa</h3>
        <p class="text-muted mb-0">
            Tambahkan data siswa baru.
        </p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.siswa.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        NISN <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="nisn"
                           class="form-control"
                           maxlength="10"
                           value="{{ old('nisn') }}"
                           placeholder="Masukkan NISN"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Siswa <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="nama_siswa"
                           class="form-control"
                           maxlength="40"
                           value="{{ old('nama_siswa') }}"
                           placeholder="Masukkan nama siswa"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Jenis Kelamin <span class="text-danger">*</span>
                    </label>

                    <select name="jenis_kelamin"
                            class="form-select"
                            required>

                        <option value="" disabled selected>
                            Pilih Jenis Kelamin
                        </option>

                        <option value="Laki-Laki"
                            {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>

                        <option value="Perempuan"
                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Tahun Masuk <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="tahun_masuk"
                           class="form-control"
                           value="{{ old('tahun_masuk', date('Y')) }}"
                           required>

                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('admin.siswa.index') }}"
                       class="btn btn-secondary px-4">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Siswa
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection