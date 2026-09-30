@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

<div class="mb-4">
    <h3 class="fw-bold mb-1">Pengaturan</h3>
    <p class="text-muted mb-0">
        Kelola pengaturan akun dan tampilan sistem.
    </p>
</div>

<div class="row g-4">

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-person-gear me-2"></i>
                    Pengaturan Akun
                </h5>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Username
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ auth()->user()->username ?? '' }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Role
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ auth()->user()->role ?? '' }}"
                        readonly>
                </div>

                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Pengaturan akun dapat dilakukan pada menu Kelola User.
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-palette me-2"></i>
                    Tampilan
                </h5>
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Mode Gelap
                        </h6>

                        <small class="text-muted">
                            Gunakan tampilan gelap pada sistem.
                        </small>
                    </div>

                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        data-theme-toggle>
                        <i class="bi bi-moon-stars"></i>
                        Ganti Tema
                    </button>

                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="mb-1 fw-semibold">
                            Status Sistem
                        </h6>

                        <small class="text-muted">
                            Sistem informasi sekolah berjalan normal.
                        </small>
                    </div>

                    <span class="badge bg-success">
                        Aktif
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

@endsection
