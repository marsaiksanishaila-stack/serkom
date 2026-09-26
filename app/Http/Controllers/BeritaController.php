<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')
            ->latest('tanggal')
            ->get();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('berita', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'foto' => $foto,
            'id_user' => 1,
        ]);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = $berita->foto;

        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }

            $foto = $request->file('foto')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'foto' => $foto,
        ]);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
