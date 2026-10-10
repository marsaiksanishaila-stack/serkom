@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <h3 class="fw-bold mb-1">Edit Data Guru</h3>
            <p class="text-muted mb-0">
                Ubah informasi data tenaga pendidik dan staf pengajar.
            </p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
                <strong>Gagal Memproses Data!</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('admin.guru.update', request()->route('id')) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Guru <span class="text-danger">*</span>
                        </label>

                        <input type="text" name="nama_guru" class="form-control @error('nama_guru') is-invalid @enderror"
                            maxlength="40" value="{{ old('nama_guru', $guru->nama_guru) }}" placeholder="Masukkan nama guru"
                            required>

                        @error('nama_guru')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            NIP
                        </label>

                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" maxlength="15"
                            value="{{ old('nip', $guru->nip) }}" placeholder="Masukkan NIP">

                        @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Mata Pelajaran
                        </label>

                        <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror"
                            maxlength="40" value="{{ old('mapel', $guru->mapel) }}" placeholder="Contoh: Matematika">

                        @error('mapel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Foto Guru
                        </label>

                        @if($guru->foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/guru/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" width="100"
                                    height="100" class="rounded-3 object-fit-cover">
                            </div>
                        @endif

                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                            accept="image/*">

                        <small class="text-muted d-block mt-1">
                            Biarkan kosong jika tidak ingin mengubah foto.
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </small>

                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary px-4">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection