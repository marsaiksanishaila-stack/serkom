<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Tampilkan semua data guru.
     */
    public function index()
    {
        $gurus = Guru::latest('id_guru')->get();
        return view('admin.guru', compact('gurus'));
    }

    /**
     * Simpan data guru baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip'       => 'nullable|string|max:15',
            'mapel'     => 'nullable|string|max:40',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $namaFoto = null;

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $namaFoto = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('guru', $namaFoto, 'public');
        }

        Guru::create([
            'nama_guru' => $request->nama_guru,
            'nip'       => $request->nip,
            'mapel'     => $request->mapel,
            'foto'      => $namaFoto,
        ]);

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil ditambahkan!');
    }

    /**
     * Perbarui data guru yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip'       => 'nullable|string|max:15',
            'mapel'     => 'nullable|string|max:40',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $namaFoto = $guru->foto;

        // Ganti foto jika file baru diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto && Storage::exists('public/guru/' . $guru->foto)) {
                Storage::delete('public/guru/' . $guru->foto);
            }

            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/guru', $namaFoto);
        }

        $guru->update([
            'nama_guru' => $request->nama_guru,
            'nip'       => $request->nip,
            'mapel'     => $request->mapel,
            'foto'      => $namaFoto,
        ]);

        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil diperbarui!');
    }

    /**
     * Hapus data guru dan fotonya dari sistem.
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        // Hapus file foto dari storage
        if ($guru->foto && Storage::exists('public/guru/' . $guru->foto)) {
            Storage::delete('public/guru/' . $guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.guru')->with('success', 'Data guru berhasil dihapus!');
    }
}
