<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::latest('tahun_ajaran');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_prestasi', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('tahun_ajaran', 'like', '%' . $request->search . '%');
            });
        }

        $prestasis = $query->get();

        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_prestasi' => 'required|max:100',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tahun_ajaran' => 'required|digits:4',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create($data);

        return redirect()
            ->route('admin.prestasi')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $data = $request->validate([
            'nama_prestasi' => 'required|max:100',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tahun_ajaran' => 'required|digits:4',
        ]);

        if ($request->hasFile('foto')) {
            if ($prestasi->foto) {
                Storage::disk('public')->delete($prestasi->foto);
            }

            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->update($data);

        return redirect()
            ->route('admin.prestasi')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->foto) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()
            ->route('admin.prestasi')
            ->with('success', 'Prestasi berhasil dihapus.');
    }
}
