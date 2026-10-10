@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <h3 class="fw-bold mb-4">Edit Pengumuman</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.pengumuman.update', request()->route('id')) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengumuman->judul) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Pengumuman</label>
                        <textarea name="isi" class="form-control" rows="7"
                            required>{{ old('isi', $pengumuman->isi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal', $pengumuman->tanggal) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>

                            <option value="Publish" {{ $pengumuman->status == 'Publish' ? 'selected' : '' }}>
                                Publish
                            </option>

                            <option value="Draft" {{ $pengumuman->status == 'Draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                        </select>
                    </div>

                    <a href="{{ route('admin.pengumuman') }}" class="btn btn-secondary">
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