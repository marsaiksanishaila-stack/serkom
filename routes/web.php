<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| WEBSITE PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/tentang', [LandingController::class, 'tentang'])->name('tentang');

Route::get('/guru', [GuruController::class, 'publicIndex'])->name('guru.index');
Route::get('/guru/{id}', [GuruController::class, 'publicShow'])->name('guru.show');

Route::get('/prestasi', [PrestasiController::class, 'publicIndex'])->name('prestasi.index');
Route::get('/prestasi/{slug}', [PrestasiController::class, 'publicShow'])->name('prestasi.show');

Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'publicShow'])->name('berita.show');

Route::get('/pengumuman', [PengumumanController::class, 'publicIndex'])->name('pengumuman.index');
Route::get('/pengumuman/{id}', [PengumumanController::class, 'publicShow'])->name('pengumuman.show');

Route::get('/galeri', [GaleriController::class, 'publicIndex'])->name('galeri.index');
Route::get('/galeri/{slug}', [GaleriController::class, 'publicShow'])->name('galeri.show');

Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'publicIndex'])->name('ekstrakurikuler.index');
Route::get('/ekstrakurikuler/{slug}', [EkstrakurikulerController::class, 'publicShow'])->name('ekstrakurikuler.show');

Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/
Route::get('/admin/pencarian', [SearchController::class, 'index'])->middleware('auth')->name('admin.search');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFIL SEKOLAH
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/profilsekolah', [ProfileController::class, 'index'])->name('admin.profilsekolah');
    Route::put('/admin/profilsekolah/{profile}', [ProfileController::class, 'update'])->name('admin.profilsekolah.update');

    /*
    |--------------------------------------------------------------------------
    | GURU
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('admin.guru.index');
    Route::get('/admin/guru/create', [GuruController::class, 'create'])->name('admin.guru.create');
    Route::post('/admin/guru', [GuruController::class, 'store'])->name('admin.guru.store');
    Route::get('/admin/guru/{id}/edit', [GuruController::class, 'edit'])->name('admin.guru.edit');
    Route::put('/admin/guru/{id}', [GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/admin/guru/{id}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');

    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/admin/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/admin/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/admin/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/admin/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    /*
    |--------------------------------------------------------------------------
    | BERITA
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin.berita');
    Route::get('/admin/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/admin/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/admin/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/admin/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

    /*
    |--------------------------------------------------------------------------
    | GALERI
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
    Route::get('/admin/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
    Route::post('/admin/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
    Route::get('/admin/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('admin.galeri.edit');
    Route::put('/admin/galeri/{id}', [GaleriController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/admin/galeri/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');

    /*
    |--------------------------------------------------------------------------
    | EKSTRAKURIKULER
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])->name('admin.ekstrakurikuler');
    Route::get('/admin/ekstrakurikuler/create', [EkstrakurikulerController::class, 'create'])->name('admin.ekstrakurikuler.create');
    Route::post('/admin/ekstrakurikuler', [EkstrakurikulerController::class, 'store'])->name('admin.ekstrakurikuler.store');
    Route::get('/admin/ekstrakurikuler/{id}/edit', [EkstrakurikulerController::class, 'edit'])->name('admin.ekstrakurikuler.edit');
    Route::put('/admin/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'update'])->name('admin.ekstrakurikuler.update');
    Route::delete('/admin/ekstrakurikuler/{id}', [EkstrakurikulerController::class, 'destroy'])->name('admin.ekstrakurikuler.destroy');

    /*
    |--------------------------------------------------------------------------
    | PENGUMUMAN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman');
    Route::get('/admin/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
    Route::post('/admin/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::get('/admin/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
    Route::put('/admin/pengumuman/{id}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('/admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');

    /*
    |--------------------------------------------------------------------------
    | PRESTASI
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/prestasi', [PrestasiController::class, 'index'])->name('admin.prestasi');
    Route::get('/admin/prestasi/create', [PrestasiController::class, 'create'])->name('admin.prestasi.create');
    Route::post('/admin/prestasi', [PrestasiController::class, 'store'])->name('admin.prestasi.store');
    Route::get('/admin/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('admin.prestasi.edit');
    Route::put('/admin/prestasi/{id}', [PrestasiController::class, 'update'])->name('admin.prestasi.update');
    Route::delete('/admin/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('admin.prestasi.destroy');

    /*
    |--------------------------------------------------------------------------
    | PROFIL USER ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/profil', [UserController::class, 'profile'])->name('admin.user.profile');
    Route::put('/admin/profil', [UserController::class, 'updateProfile'])->name('admin.user.profile.update');

});