@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <h3 class="fw-bold mb-4">Edit Prestasi</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.prestasi.update', request()->route('id')) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Prestasi</label>

                        <input type="text" name="nama_prestasi" class="form-control"
                            value="{{ old('nama_prestasi', $prestasi->nama_prestasi) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>

                        <textarea name="deskripsi" class="form-control" rows="5"
                            required>{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Sekarang</label>

                        @if($prestasi->foto)

                            <br>

                            <img src="{{ asset('storage/' . $prestasi->foto) }}" width="180" style="border-radius: 10px;">

                        @else

                            <p class="text-muted">Belum ada foto.</p>

                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>

                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>

                        <input type="text" name="tahun_ajaran" class="form-control"
                            value="{{ old('tahun_ajaran', $prestasi->tahun_ajaran) }}" maxlength="4" required>
                    </div>

                    <a href="{{ route('admin.prestasi') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection