@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <h3 class="fw-bold mb-4">Edit Ekstrakurikuler</h3>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.ekstrakurikuler.update', request()->route('id')) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Ekstrakurikuler</label>
                        <input type="text" name="nama_ekskul" class="form-control"
                            value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pembina</label>
                        <input type="text" name="pembina" class="form-control"
                            value="{{ old('pembina', $ekstrakurikuler->pembina) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jadwal Latihan</label>
                        <input type="text" name="jadwal_latihan" class="form-control"
                            value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="5"
                            required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Sekarang</label>
                        @if($ekstrakurikuler->gambar)
                            <br>
                            <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" width="180"
                                style="border-radius: 10px;">
                        @else
                            <p class="text-muted">Belum ada gambar.</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                    </div>
                    <a href="{{ route('admin.ekstrakurikuler') }}" class="btn btn-secondary">
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