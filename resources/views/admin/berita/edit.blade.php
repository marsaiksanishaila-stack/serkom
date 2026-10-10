@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <h3 class="fw-bold mb-4">Edit Berita</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                {{-- Form update berita, ID-nya diambil langsung dari parameter URL --}}
                <form action="{{ route('admin.berita.update', request()->route('id')) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Input Judul Berita --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
                    </div>

                    {{-- Input Isi Berita --}}
                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="7" required>{{ old('isi', $berita->isi) }}</textarea>
                    </div>

                    {{-- Input Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $berita->tanggal) }}" required>
                    </div>

                    {{-- Dropdown Status (Draft / Public) --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Draft" {{ old('status', $berita->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Public" {{ old('status', $berita->status) == 'Public' ? 'selected' : '' }}>Public</option>
                        </select>
                    </div>

                    {{-- Preview Foto Lama --}}
                    <div class="mb-3">
                        <label class="form-label d-block">Foto Sekarang</label>
                        @if ($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}" width="150" style="border-radius: 10px;" class="mb-2">
                        @else
                            <p class="text-muted">Belum ada foto</p>
                        @endif
                    </div>

                    {{-- Upload Foto Baru (Opsional) --}}
                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.berita') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection