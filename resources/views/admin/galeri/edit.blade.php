@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <h3 class="fw-bold mb-4">Edit Galeri</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.galeri.update', request()->route('id')) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control"
                            rows="4">{{ old('keterangan', $galeri->keterangan) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Foto" {{ $galeri->kategori == 'Foto' ? 'selected' : '' }}>
                                Foto
                            </option>

                            <option value="Video" {{ $galeri->kategori == 'Video' ? 'selected' : '' }}>
                                Video
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Sekarang</label>

                        @if($galeri->file)

                            @if($galeri->kategori == 'Foto')

                                <br>
                                <img src="{{ asset('storage/' . $galeri->file) }}" width="180" style="border-radius: 10px;">

                            @else

                                <br>
                                <video width="250" controls>
                                    <source src="{{ asset('storage/' . $galeri->file) }}">
                                </video>

                            @endif

                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti File</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal', $galeri->tanggal) }}" required>
                    </div>

                    <a href="{{ route('admin.galeri') }}" class="btn btn-secondary">
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