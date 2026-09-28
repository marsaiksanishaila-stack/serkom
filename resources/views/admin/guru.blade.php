@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">

    <!-- PAGE TITLE & ACTIONS -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold mb-1">Kelola Data Guru</h4>
            <p class="text-muted small mb-0">Manajemen data tenaga pendidik dan staf pengajar sekolah.</p>
        </div>

        @if(Auth::user()->role == 'Admin')
            <button class="btn btn-primary d-inline-flex align-items-center gap-2"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahGuru">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Guru</span>
            </button>
        @endif
    </div>

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ALERT ERROR -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- VALIDATION ERROR -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3" style="width: 50px;">No</th>
                            <th style="width: 80px;">Foto</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Mata Pelajaran</th>
                            <th class="text-end pe-3" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $index => $guru)
                            <tr>
                                <td class="ps-3 fw-medium text-muted">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    @if($guru->foto)
                                        <img src="{{ asset('storage/guru/' . $guru->foto) }}"
                                             alt="{{ $guru->nama_guru }}"
                                             class="rounded-circle object-fit-cover"
                                             width="40"
                                             height="40">
                                    @else
                                        <div class="bg-secondary-subtle text-secondary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                             style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($guru->nama_guru, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">
                                        {{ $guru->nama_guru }}
                                    </span>
                                </td>
                                <td>
                                    {{ $guru->nip ?? '-' }}
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">
                                        {{ $guru->mapel ?? 'Belum Diatur' }}
                                    </span>
                                </td>

                                <!-- AKSI -->
                                <td class="text-end pe-3">
                                    @if(Auth::user()->role == 'Admin')
                                        <div class="btn-group btn-group-sm">
                                            <!-- EDIT -->
                                            <button class="btn btn-outline-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditGuru{{ $guru->id_guru }}"
                                                    title="Edit Data">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <!-- HAPUS -->
                                            <button class="btn btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusGuru{{ $guru->id_guru }}"
                                                    title="Hapus Data">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>

                            @if(Auth::user()->role == 'Admin')
                                <!-- MODAL EDIT GURU -->
                                <div class="modal fade"
                                     id="modalEditGuru{{ $guru->id_guru }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.guru.update', $guru->id_guru) }}"
                                                  method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Edit Data Guru</h5>
                                                    <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Nama Guru <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"
                                                               name="nama_guru"
                                                               class="form-control"
                                                               maxlength="40"
                                                               value="{{ old('nama_guru', $guru->nama_guru) }}"
                                                               required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">NIP</label>
                                                        <input type="text"
                                                               name="nip"
                                                               class="form-control"
                                                               maxlength="15"
                                                               value="{{ old('nip', $guru->nip) }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Mata Pelajaran</label>
                                                        <input type="text"
                                                               name="mapel"
                                                               class="form-control"
                                                               maxlength="40"
                                                               value="{{ old('mapel', $guru->mapel) }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Foto</label>
                                                        <input type="file"
                                                               name="foto"
                                                               class="form-control"
                                                               accept="image/*">
                                                        <small class="text-muted">
                                                            Biarkan kosong jika tidak ingin mengubah foto.
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button"
                                                            class="btn btn-light"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit"
                                                            class="btn btn-warning">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL HAPUS GURU -->
                                <div class="modal fade"
                                     id="modalHapusGuru{{ $guru->id_guru }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.guru.destroy', $guru->id_guru) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-body text-center pt-4">
                                                    <i class="bi bi-exclamation-triangle text-warning display-4"></i>
                                                    <h5 class="fw-bold mt-3">Konfirmasi Hapus</h5>
                                                    <p class="text-muted">
                                                        Apakah Anda yakin ingin menghapus data
                                                        <strong>{{ $guru->nama_guru }}</strong>?
                                                    </p>
                                                </div>

                                                <div class="modal-footer justify-content-center border-0 pb-4">
                                                    <button type="button"
                                                            class="btn btn-light px-4"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit"
                                                            class="btn btn-danger px-4">Ya, Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-person-workspace display-6 d-block mb-2"></i>
                                    <span>Belum ada data guru yang tersimpan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH GURU -->
@if(Auth::user()->role == 'Admin')
    <div class="modal fade"
         id="modalTambahGuru"
         tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.guru.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Tambah Data Guru</h5>
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">
                                Nama Guru <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="nama_guru"
                                   class="form-control"
                                   placeholder="Masukkan nama guru"
                                   maxlength="40"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text"
                                   name="nip"
                                   class="form-control"
                                   placeholder="Masukkan NIP"
                                   maxlength="15">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <input type="text"
                                   name="mapel"
                                   class="form-control"
                                   placeholder="Contoh: Matematika"
                                   maxlength="40">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Guru</label>
                            <input type="file"
                                   name="foto"
                                   class="form-control"
                                   accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                                class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@endsection