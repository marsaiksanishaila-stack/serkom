<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::latest()->get();

        return view('admin.ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|max:40',
            'pembina' => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create([
            'nama_ekskul' => $request->nama_ekskul,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $request->validate([
            'nama_ekskul' => 'required|max:40',
            'pembina' => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambar = $ekstrakurikuler->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }

            $gambar = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->update([
            'nama_ekskul' => $request->nama_ekskul,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        if ($ekstrakurikuler->gambar) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
