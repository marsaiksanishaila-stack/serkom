@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Pengaturan</h3>
        <p class="text-muted mb-0">Kelola pengaturan akun dan tampilan sistem.</p>
    </div>

    <div class="row g-4">
        {{-- PENGATURAN AKUN --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom py-3 rounded-top-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-gear me-2 text-primary"></i> Pengaturan Akun
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control bg-light" value="{{ auth()->user()->username ?? '' }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Role</label>
                        <input type="text" class="form-control bg-light" value="{{ auth()->user()->role ?? '' }}" readonly>
                    </div>

                    <div class="alert alert-info border-0 rounded-3 mb-0 d-flex align-items-center">
                        <i class="bi bi-info-circle fs-5 me-2"></i>
                        <span>Pengaturan akun dapat dilakukan pada menu <strong>Kelola User</strong>.</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENGATURAN TAMPILAN --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom py-3 rounded-top-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-palette me-2 text-primary"></i> Tampilan & Sistem
                    </h5>
                </div>
                <div class="card-body p-4">
                    {{-- DART MODE TOGGLE --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-1 fw-semibold">Mode Gelap</h6>
                            <small class="text-muted">Gunakan tampilan gelap pada sistem.</small>
                        </div>
                        <button type="button" class="btn btn-outline-primary rounded-3 px-3" id="themeToggleBtn">
                            <i class="bi bi-moon-stars me-1" id="themeIcon"></i>
                            <span id="themeText">Ganti Tema</span>
                        </button>
                    </div>

                    <hr class="my-4">

                    {{-- STATUS SISTEM --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 fw-semibold">Status Sistem</h6>
                            <small class="text-muted">Sistem informasi sekolah berjalan normal.</small>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i> Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- SCRIPT DARK MODE TOGGLE (BOOTSTRAP 5) --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('themeToggleBtn');
        const themeIcon = document.getElementById('themeIcon');
        const themeText = document.getElementById('themeText');
        const htmlElement = document.documentElement;

        // Cek preferensi tema sebelumnya
        const currentTheme = localStorage.getItem('theme') || 'light';
        htmlElement.setAttribute('data-bs-theme', currentTheme);
        updateUI(currentTheme);

        toggleBtn.addEventListener('click', function () {
            let newTheme = htmlElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateUI(newTheme);
        });

        function updateUI(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'bi bi-sun me-1';
                themeText.textContent = 'Mode Terang';
                toggleBtn.classList.replace('btn-outline-primary', 'btn-outline-warning');
            } else {
                themeIcon.className = 'bi bi-moon-stars me-1';
                themeText.textContent = 'Mode Gelap';
                toggleBtn.classList.replace('btn-outline-warning', 'btn-outline-primary');
            }
        }
    });
</script>
@endpush
@endsection