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

// LOGIN
Route::get('/', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// ADMIN DASHBOARD
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

// PROFIL
Route::get('/admin/profil', [ProfileController::class, 'index'])
    ->name('admin.profil');

Route::put('/admin/profil/{profile}', [ProfileController::class, 'update'])
    ->name('admin.profil.update');

// GURU
Route::get('/guru', [GuruController::class, 'index'])
    ->name('admin.guru');

Route::get('/guru/create', [GuruController::class, 'create'])
    ->middleware('admin')
    ->name('admin.guru.create');

Route::post('/guru', [GuruController::class, 'store'])
    ->middleware('admin')
    ->name('admin.guru.store');

Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])
    ->middleware('admin')
    ->name('admin.guru.edit');

Route::put('/guru/{guru}', [GuruController::class, 'update'])
    ->middleware('admin')
    ->name('admin.guru.update');

Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])
    ->middleware('admin')
    ->name('admin.guru.destroy');

// SISWA
Route::get('/admin/siswa', [SiswaController::class, 'index'])
    ->name('admin.siswa.index');

Route::get('/siswa/create', [SiswaController::class, 'create'])
    ->middleware('admin')
    ->name('admin.siswa.create');

Route::post('/siswa', [SiswaController::class, 'store'])
    ->middleware('admin')
    ->name('admin.siswa.store');

Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])
    ->middleware('admin')
    ->name('admin.siswa.edit');

Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])
    ->middleware('admin')
    ->name('admin.siswa.update');

Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])
    ->middleware('admin')
    ->name('admin.siswa.destroy');

// USER MANAGEMENT
Route::get('/user', [UserController::class, 'index'])
    ->name('admin.user.index');

Route::get('/user/create', [UserController::class, 'create'])
    ->name('admin.user.create');

Route::post('/user', [UserController::class, 'store'])
    ->name('admin.user.store');

Route::get('/user/{user}/edit', [UserController::class, 'edit'])
    ->name('admin.user.edit');

Route::put('/user/{user}', [UserController::class, 'update'])
    ->name('admin.user.update');

Route::delete('/user/{user}', [UserController::class, 'destroy'])
    ->name('admin.user.destroy');

// BERITA
Route::get('/berita', [BeritaController::class, 'index'])
    ->name('admin.berita');

Route::get('/berita/create', [BeritaController::class, 'create'])
    ->name('admin.berita.create');

Route::post('/berita', [BeritaController::class, 'store'])
    ->name('admin.berita.store');

Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])
    ->name('admin.berita.edit');

Route::put('/berita/{berita}', [BeritaController::class, 'update'])
    ->name('admin.berita.update');

Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])
    ->name('admin.berita.destroy');

// GALERI
Route::get('/galeri', [GaleriController::class, 'index'])
    ->name('admin.galeri');

Route::get('/galeri/create', [GaleriController::class, 'create'])
    ->name('admin.galeri.create');

Route::post('/galeri', [GaleriController::class, 'store'])
    ->name('admin.galeri.store');

Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])
    ->name('admin.galeri.edit');

Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])
    ->name('admin.galeri.update');

Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])
    ->name('admin.galeri.destroy');

// EKSTRAKURIKULER
Route::get('/ekstrakurikuler', [EkstrakurikulerController::class, 'index'])
    ->name('admin.ekstrakurikuler');

Route::get('/ekstrakurikuler/create', [EkstrakurikulerController::class, 'create'])
    ->name('admin.ekstrakurikuler.create');

Route::post('/ekstrakurikuler', [EkstrakurikulerController::class, 'store'])
    ->name('admin.ekstrakurikuler.store');

Route::get('/ekstrakurikuler/{ekstrakurikuler}/edit', [EkstrakurikulerController::class, 'edit'])
    ->name('admin.ekstrakurikuler.edit');

Route::put('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'update'])
    ->name('admin.ekstrakurikuler.update');

Route::delete('/ekstrakurikuler/{ekstrakurikuler}', [EkstrakurikulerController::class, 'destroy'])
    ->name('admin.ekstrakurikuler.destroy');

// PENGUMUMAN
Route::get('/pengumuman', [PengumumanController::class, 'index'])
    ->name('admin.pengumuman');

Route::get('/pengumuman/create', [PengumumanController::class, 'create'])
    ->name('admin.pengumuman.create');

Route::post('/pengumuman', [PengumumanController::class, 'store'])
    ->name('admin.pengumuman.store');

Route::get('/pengumuman/{pengumuman}/edit', [PengumumanController::class, 'edit'])
    ->name('admin.pengumuman.edit');

Route::put('/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])
    ->name('admin.pengumuman.update');

Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])
    ->name('admin.pengumuman.destroy');

// PRESTASI
Route::get('/prestasi', [PrestasiController::class, 'index'])
    ->name('admin.prestasi');

Route::get('/prestasi/create', [PrestasiController::class, 'create'])
    ->name('admin.prestasi.create');

Route::post('/prestasi', [PrestasiController::class, 'store'])
    ->name('admin.prestasi.store');

Route::get('/prestasi/{prestasi}/edit', [PrestasiController::class, 'edit'])
    ->name('admin.prestasi.edit');

Route::put('/prestasi/{prestasi}', [PrestasiController::class, 'update'])
    ->name('admin.prestasi.update');

Route::delete('/prestasi/{prestasi}', [PrestasiController::class, 'destroy'])
    ->name('admin.prestasi.destroy');