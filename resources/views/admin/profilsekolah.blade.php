@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <!-- HEADER & TOGGLE BUTTON -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Profil Sekolah</h3>
            <p class="text-muted mb-0">Kelola identitas, kontak, dan informasi resmi sekolah</p>
        </div>
        <ul class="nav nav-pills bg-light p-1 rounded-3 border" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-2 px-3 py-2 fw-semibold" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-pane" type="button" role="tab">
                    <i class="bi bi-person-badge me-1"></i> Lihat Profil
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-2 px-3 py-2 fw-semibold" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit-pane" type="button" role="tab">
                    <i class="bi bi-pencil-square me-1"></i> Edit Data
                </button>
            </li>
        </ul>
    </div>

    <!-- NOTIFIKASI SUKSES -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- NOTIFIKASI ERROR VALIDASI -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center mb-1">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                <strong>Gagal Menyimpan Data!</strong>
            </div>
            <ul class="mb-0 ps-4 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- CONTENT TAB -->
    <div class="tab-content" id="profileTabContent">

        <!-- ==================== 1. TAMPILAN PROFIL (CARD MODERN) ==================== -->
        <div class="tab-pane fade show active" id="view-pane" role="tabpanel" tabindex="0">
            <div class="row g-4">

                <!-- KARTU KIRI: LOGO & KEPALA SEKOLAH -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden text-center p-4">
                        <div class="position-relative d-inline-block mx-auto mb-3">
                            @if (!empty($profile->logo))
                                <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" class="rounded-circle border p-2 bg-white shadow-sm" style="width: 130px; height: 130px; object-fit: contain;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto border" style="width: 130px; height: 130px;">
                                    <i class="bi bi-building fs-1 text-muted"></i>
                                </div>
                            @endif
                        </div>

                        <h4 class="fw-bold mb-1 text-dark">{{ $profile->nama_sekolah ?? 'Nama Sekolah' }}</h4>
                        <p class="text-muted small mb-3">NPSN: {{ $profile->npsn ?? '-' }}</p>

                        <div class="p-3 bg-light rounded-3 text-start mb-3">
                            <small class="text-muted d-block fw-semibold mb-1">Kepala Sekolah</small>
                            <span class="fw-bold text-dark d-flex align-items-center">
                                <i class="bi bi-person-workspace text-primary me-2 fs-5"></i>
                                {{ $profile->kepala_sekolah ?? '-' }}
                            </span>
                        </div>

                        <div class="row g-2 text-center">
                            <div class="col-6">
                                <div class="p-2 border rounded-3">
                                    <small class="text-muted d-block">Tahun Berdiri</small>
                                    <span class="fw-bold text-dark">{{ $profile->tahun_berdiri ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border rounded-3">
                                    <small class="text-muted d-block">Kontak</small>
                                    <span class="fw-bold text-dark">{{ $profile->kontak ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FOTO GEDUNG / PROFIL -->
                    @if (!empty($profile->foto))
                        <div class="card border-0 shadow-sm rounded-4 mt-4 overflow-hidden">
                            <div class="card-header bg-white border-0 pt-3 px-3">
                                <span class="fw-bold text-dark small"><i class="bi bi-image me-1 text-primary"></i> Gedung / Profil Utama</span>
                            </div>
                            <div class="card-body p-3 pt-0">
                                <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Sekolah" class="img-fluid rounded-3 w-100 object-fit-cover" style="max-height: 200px;">
                            </div>
                        </div>
                    @endif
                </div>

                <!-- KARTU KANAN: DETAIL INFORMASI -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4">

                        <div class="mb-4">
                            <h6 class="fw-bold text-primary text-uppercase fs-7 tracking-wide mb-2"><i class="bi bi-geo-alt me-1"></i> Alamat Lengkap</h6>
                            <p class="text-dark bg-light p-3 rounded-3 mb-0">{{ $profile->alamat ?? 'Alamat belum diisi.' }}</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold text-primary text-uppercase fs-7 tracking-wide mb-2"><i class="bi bi-compass me-1"></i> Visi & Misi</h6>
                            <div class="p-3 bg-light rounded-3 text-secondary" style="white-space: pre-line; leading-trim: both;">{{ $profile->visi_misi ?? 'Visi & Misi belum diisi.' }}</div>
                        </div>

                        <div>
                            <h6 class="fw-bold text-primary text-uppercase fs-7 tracking-wide mb-2"><i class="bi bi-journal-text me-1"></i> Sejarah / Deskripsi Singkat</h6>
                            <div class="p-3 bg-light rounded-3 text-secondary" style="white-space: pre-line;">{{ $profile->deskripsi ?? 'Deskripsi belum diisi.' }}</div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== 2. FORM EDIT PROFIL ==================== -->
        <div class="tab-pane fade" id="edit-pane" role="tabpanel" tabindex="0">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.profilsekolah.update', $profile->id_profile ?? 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark">Nama Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_sekolah" class="form-control form-control-lg fs-6" value="{{ old('nama_sekolah', $profile->nama_sekolah ?? '') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark">Kepala Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="kepala_sekolah" class="form-control form-control-lg fs-6" value="{{ old('kepala_sekolah', $profile->kepala_sekolah ?? '') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark">NPSN</label>
                                <input type="text" name="npsn" class="form-control" value="{{ old('npsn', $profile->npsn ?? '') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark">Kontak / Telepon</label>
                                <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $profile->kontak ?? '') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark">Tahun Berdiri</label>
                                <input type="number" name="tahun_berdiri" class="form-control" value="{{ old('tahun_berdiri', $profile->tahun_berdiri ?? '') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark">Logo Sekolah</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                <small class="text-muted">Format: PNG, JPG (Maks 2MB)</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark">Foto Profil / Gedung</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG (Maks 4MB)</small>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark">Visi & Misi</label>
                                <textarea name="visi_misi" class="form-control" rows="4">{{ old('visi_misi', $profile->visi_misi ?? '') }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark">Deskripsi / Sejarah</label>
                                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top text-end">
                            <button type="submit" class="btn btn-primary btn-lg px-4 fs-6 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- OTOMATIS BUKA TAB EDIT JIKA ADA ERROR VALIDASI -->
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var editTab = new bootstrap.Tab(document.getElementById('edit-tab'));
        editTab.show();
    });
</script>
@endif

@endsection