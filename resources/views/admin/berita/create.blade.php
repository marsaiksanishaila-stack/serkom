@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <h3 class="fw-bold mb-4">Tambah Berita</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                {{-- Form simpan berita baru (pake enctype karena ada upload file foto) --}}
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Input Judul Berita --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                    </div>

                    {{-- Input Isi Berita --}}
                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="7" required>{{ old('isi') }}</textarea>
                    </div>

                    {{-- Input Tanggal (Default diisi tanggal hari ini YYYY-MM-DD) --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>

                    {{-- Dropdown Status (Default terpilih: Draft) --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Draft" {{ old('status', 'Draft') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Public" {{ old('status') == 'Public' ? 'selected' : '' }}>Public</option>
                        </select>
                    </div>

                    {{-- Upload Foto Berita --}}
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    {{-- Tombol Navigasi & Submit --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.berita') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection