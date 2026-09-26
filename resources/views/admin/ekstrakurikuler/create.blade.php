@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <h3 class="fw-bold mb-4">Tambah Ekstrakurikuler</h3>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.ekstrakurikuler.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Ekstrakurikuler</label>
                    <input type="text"
                           name="nama_ekskul"
                           class="form-control"
                           value="{{ old('nama_ekskul') }}"
                           required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pembina</label>
                    <input type="text"
                           name="pembina"
                           class="form-control"
                           value="{{ old('pembina') }}"
                           required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jadwal Latihan</label>
                    <input type="text"
                           name="jadwal_latihan"
                           class="form-control"
                           placeholder="Contoh: Jumat, 14.00 - 16.00"
                           value="{{ old('jadwal_latihan') }}"
                           required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="5"
                              required>{{ old('deskripsi') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file"
                           name="gambar"
                           class="form-control"
                           accept="image/*">
                </div>
                <a href="{{ route('admin.ekstrakurikuler') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
