<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Siswa;
use App\Http\Requests\UpdateProfileRequest; // Menggunakan Custom Request untuk validasi khusus
use Illuminate\Support\Facades\Storage;     // Untuk mengelola hapus & simpan foto/logo

class ProfileController extends Controller
{
    // --- HALAMAN PROFIL SEKOLAH (ADMIN) ---
    public function index()
    {
        // Ambil data profil sekolah ID 1.
        // Jika belum ada di database, otomatis buatkan data bawaan (default) ini:
        $profile = Profile::firstOrCreate(
            ['id_profile' => 1],
            [
                'nama_sekolah' => 'SMK YPC Tasikmalaya',
                'kepala_sekolah' => 'Nama Kepala Sekolah'
            ]
        );

        // Ambil daftar data siswa (dibagi per 10 data per halaman / pagination)
        $siswas = Siswa::paginate(10);

        // Tampilkan ke halaman Blade admin.profilsekolah
        return view('admin.profilsekolah', compact('profile', 'siswas'));
    }

    // --- PROSES UPDATE PROFIL SEKOLAH ---
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        // Ambil data inputan yang sudah lolos validasi dari UpdateProfileRequest
        $data = $request->validated();

        // 1. PENANGANAN UPLOAD FOTO PROFIL / HERO
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage jika ada
            if ($profile->foto && Storage::disk('public')->exists($profile->foto)) {
                Storage::disk('public')->delete($profile->foto);
            }

            // Simpan foto baru ke folder 'storage/app/public/profile'
            $data['foto'] = $request->file('foto')->store('profile', 'public');
        }

        // 2. PENANGANAN UPLOAD LOGO SEKOLAH
        if ($request->hasFile('logo')) {
            // Hapus logo lama dari storage jika ada
            if ($profile->logo && Storage::disk('public')->exists($profile->logo)) {
                Storage::disk('public')->delete($profile->logo);
            }

            // Simpan logo baru ke folder 'storage/app/public/profile'
            $data['logo'] = $request->file('logo')->store('profile', 'public');
        }

        // Update data profil sekolah di database
        $profile->update($data);

        return redirect()
            ->route('admin.profilsekolah')
            ->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}