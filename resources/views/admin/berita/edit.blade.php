@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <h3 class="fw-bold mb-4">Edit Berita</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="7" required>{{ old('isi', $berita->isi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal', $berita->tanggal) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Sekarang</label>

                        @if ($berita->foto)
                            <br>
                            <img src="{{ asset('storage/' . $berita->foto) }}" width="150" style="border-radius: 10px;"
                                class="mb-2">
                        @else
                            <p class="text-muted">Belum ada foto</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <a href="{{ route('admin.berita') }}" class="btn btn-secondary">
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
