<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrCreate(
            ['id_profile' => 1],
            ['nama_sekolah' => 'SMK Negeri 1 Singaparna', 'kepala_sekolah' => 'Nama Kepala Sekolah']
        );

        return view('admin.profil', compact('profile'));
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $data = $request->validated();

        // Upload Foto
        if ($request->hasFile('foto')) {
            if ($profile->foto && Storage::disk('public')->exists($profile->foto)) {
                Storage::disk('public')->delete($profile->foto);
            }
            $data['foto'] = $request->file('foto')->store('profile', 'public');
        }

        // Upload Logo
        if ($request->hasFile('logo')) {
            if ($profile->logo && Storage::disk('public')->exists($profile->logo)) {
                Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('profile', 'public');
        }

        // Simpan perubahan
        $profile->update($data);

        return redirect()->route('admin.profil.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}
