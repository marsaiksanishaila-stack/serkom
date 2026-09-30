<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Siswa;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrCreate(
            ['id_profile' => 1],
            [
                'nama_sekolah' => 'SMK YPC Tasikmalaya',
                'kepala_sekolah' => 'Nama Kepala Sekolah'
            ]
        );

        $siswas = Siswa::paginate(10);

        return view('admin.profilsekolah', compact('profile', 'siswas'));
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($profile->foto && Storage::disk('public')->exists($profile->foto)) {
                Storage::disk('public')->delete($profile->foto);
            }

            $data['foto'] = $request->file('foto')->store('profile', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($profile->logo && Storage::disk('public')->exists($profile->logo)) {
                Storage::disk('public')->delete($profile->logo);
            }

            $data['logo'] = $request->file('logo')->store('profile', 'public');
        }

        $profile->update($data);

        return redirect()
            ->route('admin.profilsekolah')
            ->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}