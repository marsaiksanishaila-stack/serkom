@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h3 class="fw-bold mb-4">Tambah Galeri</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.galeri.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="4">{{ old('keterangan') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Foto">Foto</option>
                        <option value="Video">Video</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">File</label>
                    <input type="file"
                           name="file"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', date('Y-m-d')) }}"
                           required>
                </div>

                <a href="{{ route('admin.galeri') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

@endsection
