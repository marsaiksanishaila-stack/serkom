@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Data Siswa</h3>
            <p class="text-muted mb-0">Kelola data seluruh siswa sekolah</p>
        </div>

        @if(Auth::user()->role == 'Admin')
            <button class="btn btn-primary px-3 rounded-3 shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Siswa
            </button>
        @endif
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <strong>Gagal Memproses Data!</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TABEL DATA -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">NISN</th>
                            <th class="py-3">Nama Siswa</th>
                            <th class="py-3">Jenis Kelamin</th>
                            <th class="py-3">Tahun Masuk</th>
                            <th class="text-end pe-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $key => $item)
                            <tr>
                                <td class="ps-4">
                                    {{ $siswas->firstItem() + $key }}
                                </td>
                                <td class="fw-semibold text-dark">
                                    {{ $item->nisn }}
                                </td>
                                <td class="fw-bold text-dark">
                                    {{ $item->nama_siswa }}
                                </td>
                                <td>
                                    <span class="badge {{ $item->jenis_kelamin == 'Laki-Laki' ? 'bg-info-subtle text-info' : 'bg-danger-subtle text-danger' }} px-3 py-2">
                                        {{ $item->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                        {{ $item->tahun_masuk }}
                                    </span>
                                </td>

                                <!-- AKSI -->
                                <td class="text-end pe-4">
                                    @if(Auth::user()->role == 'Admin')
                                        <div class="btn-group btn-group-sm">
                                            <!-- EDIT -->
                                            <button class="btn btn-outline-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $item->id_siswa }}"
                                                    title="Edit Data">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <!-- HAPUS -->
                                            <button class="btn btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalHapus{{ $item->id_siswa }}"
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
                                <!-- MODAL EDIT -->
                                <div class="modal fade"
                                     id="modalEdit{{ $item->id_siswa }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4">
                                            <div class="modal-header border-bottom-0">
                                                <h5 class="modal-title fw-bold">Edit Data Siswa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('admin.siswa.update', $item->id_siswa) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">NISN</label>
                                                        <input type="text"
                                                               name="nisn"
                                                               class="form-control"
                                                               maxlength="10"
                                                               value="{{ old('nisn', $item->nisn) }}"
                                                               required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Nama Siswa</label>
                                                        <input type="text"
                                                               name="nama_siswa"
                                                               class="form-control"
                                                               maxlength="40"
                                                               value="{{ old('nama_siswa', $item->nama_siswa) }}"
                                                               required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-select" required>
                                                            <option value="Laki-Laki" {{ $item->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                                Laki-Laki
                                                            </option>
                                                            <option value="Perempuan" {{ $item->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                Perempuan
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Tahun Masuk</label>
                                                        <input type="number"
                                                               name="tahun_masuk"
                                                               class="form-control"
                                                               value="{{ old('tahun_masuk', $item->tahun_masuk) }}"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-top-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL HAPUS -->
                                <div class="modal fade"
                                     id="modalHapus{{ $item->id_siswa }}"
                                     tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow rounded-4 text-center p-3">
                                            <div class="modal-body">
                                                <i class="bi bi-exclamation-circle text-danger display-4 mb-2 d-block"></i>
                                                <h5 class="fw-bold mb-1">Hapus Data?</h5>
                                                <p class="text-muted small mb-3">
                                                    Siswa <strong>{{ $item->nama_siswa }}</strong> akan dihapus permanen.
                                                </p>

                                                <form action="{{ route('admin.siswa.destroy', $item->id_siswa) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button" class="btn btn-light w-100 mb-2" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger w-100">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-people fs-1 d-block mb-2"></i>
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($siswas->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $siswas->links() }}
            </div>
        @endif
    </div>
</div>

<!-- MODAL TAMBAH -->
@if(Auth::user()->role == 'Admin')
    <div class="modal fade"
         id="modalTambah"
         tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold">Tambah Siswa Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                NISN <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="nisn"
                                   class="form-control"
                                   maxlength="10"
                                   placeholder="10 digit NISN"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Nama Siswa <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="nama_siswa"
                                   class="form-control"
                                   maxlength="40"
                                   placeholder="Masukkan Nama Siswa"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Tahun Masuk <span class="text-danger">*</span>
                            </label>
                            <input type="number"
                                   name="tahun_masuk"
                                   class="form-control"
                                   value="{{ date('Y') }}"
                                   placeholder="Contoh: 2024"
                                   required>
                        </div>
                    </div>

                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@endsection