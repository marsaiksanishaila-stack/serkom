@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">

        <div>
            <h3 class="fw-bold mb-1">
                Kelola Data Siswa
            </h3>

            <p class="text-muted mb-0">
                Kelola data siswa sekolah.
            </p>
        </div>

        @if(Auth::user()->role == 'Admin')
            <a href="{{ route('admin.siswa.create') }}"
               class="btn btn-primary px-3 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Siswa
            </a>
        @endif

    </div>


    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    <!-- SEARCH -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">

            <form action="{{ route('admin.siswa.index') }}"
                  method="GET">

                <div class="row g-2">

                    <div class="col-md-10">
                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search text-muted"></i>
                            </span>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Cari nama siswa atau NISN...">

                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit"
                                class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>


    <!-- TABLE -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>

                            <th class="px-4 py-3">
                                No
                            </th>

                            <th>
                                NISN
                            </th>

                            <th>
                                Nama Siswa
                            </th>

                            <th>
                                Jenis Kelamin
                            </th>

                            <th>
                                Tahun Masuk
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($siswas as $item)

                            <tr>

                                <td class="px-4">
                                    {{ $siswas->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $item->nisn }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-2">

                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                             style="width: 38px; height: 38px;">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <span class="fw-semibold">
                                            {{ $item->nama_siswa }}
                                        </span>

                                    </div>
                                </td>

                                <td>

                                    @if($item->jenis_kelamin == 'Laki-Laki')

                                        <span class="badge bg-primary-subtle text-primary">
                                            <i class="bi bi-gender-male me-1"></i>
                                            Laki-Laki
                                        </span>

                                    @else

                                        <span class="badge bg-danger-subtle text-danger">
                                            <i class="bi bi-gender-female me-1"></i>
                                            Perempuan
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $item->tahun_masuk }}
                                </td>

                                <td class="text-center">

                                    @if(Auth::user()->role == 'Admin')

                                        <div class="btn-group btn-group-sm">

                                            <!-- EDIT -->
                                            <a href="{{ route('admin.siswa.edit', $item->id_siswa) }}"
                                               class="btn btn-outline-warning"
                                               title="Edit Data">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            <!-- HAPUS -->
                                            <button type="button"
                                                    class="btn btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalHapus{{ $item->id_siswa }}"
                                                    title="Hapus Data">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </div>

                                    @else

                                        <span class="text-muted small">
                                            -
                                        </span>

                                    @endif

                                </td>

                            </tr>


                            <!-- MODAL HAPUS -->
                            @if(Auth::user()->role == 'Admin')

                                <div class="modal fade"
                                     id="modalHapus{{ $item->id_siswa }}"
                                     tabindex="-1"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content border-0 shadow rounded-4">

                                            <div class="modal-header border-0">

                                                <h5 class="modal-title fw-bold">
                                                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                                                    Hapus Data Siswa
                                                </h5>

                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal">
                                                </button>

                                            </div>


                                            <div class="modal-body">

                                                <p class="mb-2">
                                                    Apakah kamu yakin ingin menghapus data siswa:
                                                </p>

                                                <div class="alert alert-light border rounded-3">

                                                    <strong>
                                                        {{ $item->nama_siswa }}
                                                    </strong>

                                                    <br>

                                                    <small class="text-muted">
                                                        NISN: {{ $item->nisn }}
                                                    </small>

                                                </div>

                                                <p class="text-danger small mb-0">
                                                    Data yang sudah dihapus tidak dapat dikembalikan.
                                                </p>

                                            </div>


                                            <div class="modal-footer border-0">

                                                <button type="button"
                                                        class="btn btn-light"
                                                        data-bs-dismiss="modal">

                                                    Batal

                                                </button>


                                                <form action="{{ route('admin.siswa.destroy', $item->id_siswa) }}"
                                                      method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-danger">

                                                        <i class="bi bi-trash me-1"></i>
                                                        Hapus

                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-person-x fs-1 d-block mb-3"></i>

                                        <h6 class="fw-bold">
                                            Data siswa belum tersedia
                                        </h6>

                                        <p class="mb-0">
                                            Belum ada data siswa yang ditemukan.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- PAGINATION -->
        @if($siswas->hasPages())

            <div class="card-footer bg-transparent border-0 px-4 py-3">

                {{ $siswas->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection