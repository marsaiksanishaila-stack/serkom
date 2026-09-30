<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $query = Guru::query();

        if (request('search')) {
            $search = request('search');

            $query->where(function ($q) use ($search) {
                $q->where('nama_guru', 'like', '%' . $search . '%')
                  ->orWhere('nip', 'like', '%' . $search . '%')
                  ->orWhere('mapel', 'like', '%' . $search . '%');
            });
        }

        $gurus = $query
            ->orderBy('id_guru', 'desc')
            ->get();

        return view('admin.guru', compact('gurus'));
    }

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

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists('guru/' . $guru->foto)) {
                Storage::disk('public')->delete('guru/' . $guru->foto);
            }

            $file = $request->file('foto');

            $namaFoto = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('guru', $namaFoto, 'public');
        }

        $guru->update([
            'nama_guru' => $request->nama_guru,
            'nip'       => $request->nip,
            'mapel'     => $request->mapel,
            'foto'      => $namaFoto,
        ]);

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->foto && Storage::disk('public')->exists('guru/' . $guru->foto)) {
            Storage::disk('public')->delete('guru/' . $guru->foto);
        }

        $guru->delete();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil dihapus!');
    }
}
