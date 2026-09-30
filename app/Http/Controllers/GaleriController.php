<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('kategori') && in_array($request->kategori, ['Foto', 'Video'])) {
            $query->where('kategori', $request->kategori);
        }

        $galeris = $query
            ->latest('tanggal')
            ->get();

        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'keterangan' => 'nullable',
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        $file = $request->file('file')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'file' => $file,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|max:50',
            'keterangan' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        $file = $galeri->file;

        if ($request->hasFile('file')) {
            if ($file) {
                Storage::disk('public')->delete($file);
            }

            $file = $request->file('file')->store('galeri', 'public');
        }

        $galeri->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'file' => $file,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}