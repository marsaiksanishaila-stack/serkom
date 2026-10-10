<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk menghapus/menyimpan file foto
use Illuminate\Support\Facades\Crypt;   // Untuk enkripsi & dekripsi ID di URL
use Illuminate\Support\Str;              // Untuk membuat slug otomatis dari nama ekskul

class EkstrakurikulerController extends Controller
{
    // --- HALAMAN UTAMA ADMIN EKSTRAKURIKULER ---
    public function index(Request $request)
    {
        $query = Ekstrakurikuler::query();

        // Fitur pencarian: cari berdasarkan nama ekskul, pembina, jadwal, atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_ekskul', 'like', '%' . $search . '%')
                    ->orWhere('pembina', 'like', '%' . $search . '%')
                    ->orWhere('jadwal_latihan', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Urutkan dari data yang paling baru ditambahkan
        $ekstrakurikulers = $query
            ->latest('id_ekskul')
            ->get();

        // Enkripsi ID ekskul agar aman dan tidak berupa angka acak di URL
        foreach ($ekstrakurikulers as $ekstrakurikuler) {
            $ekstrakurikuler->encrypted_id = Crypt::encrypt(
                $ekstrakurikuler->id_ekskul
            );
        }

        return view(
            'admin.ekstrakurikuler.index',
            compact('ekstrakurikulers')
        );
    }

    // --- FORM TAMBAH EKSTRAKURIKULER ---
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    // --- PROSES SIMPAN EKSTRAKURIKULER BARU ---
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama_ekskul' => 'required|max:40',
            'pembina' => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Opsional, maks 2MB
        ]);

        // Buat slug otomatis dari nama ekskul (misal: "Pramuka Bantara" -> "pramuka-bantara")
        $slug = Str::slug($request->nama_ekskul);
        $slugAsli = $slug;
        $counter = 1;

        // Cek jika slug sudah ada, beri tambahan angka di belakangnya agar tetap unik
        while (Ekstrakurikuler::where('slug', $slug)->exists()) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        $gambar = null;

        // Simpan gambar jika ada file yang diunggah
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')
                ->store('ekstrakurikuler', 'public');
        }

        // Simpan data ke database
        Ekstrakurikuler::create([
            'nama_ekskul' => $request->nama_ekskul,
            'slug' => $slug,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    // --- FORM EDIT EKSTRAKURIKULER ---
    public function edit($id)
    {
        // Dekripsi ID dari URL
        try {
            $idEkskul = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // Jika ID tidak valid, tampilkan error 404
        }

        $ekstrakurikuler = Ekstrakurikuler::findOrFail($idEkskul);

        return view(
            'admin.ekstrakurikuler.edit',
            compact('ekstrakurikuler')
        );
    }

    // --- PROSES UPDATE DATA EKSTRAKURIKULER ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID
        try {
            $idEkskul = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $ekstrakurikuler = Ekstrakurikuler::findOrFail($idEkskul);

        // Validasi inputan
        $request->validate([
            'nama_ekskul' => 'required|max:40',
            'pembina' => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Regenerasi slug jika nama ekskul diubah
        $slug = Str::slug($request->nama_ekskul);
        $slugAsli = $slug;
        $counter = 1;

        // Pastikan slug unik (abaikan untuk data ekskul yang sedang diedit ini)
        while (
            Ekstrakurikuler::where('slug', $slug)
                ->where('id_ekskul', '!=', $ekstrakurikuler->id_ekskul)
                ->exists()
        ) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        $gambar = $ekstrakurikuler->gambar; // Simpan path gambar lama

        // Jika user memilih untuk mengunggah gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage jika ada
            if ($gambar) {
                Storage::disk('public')->delete($gambar);
            }

            // Simpan gambar baru
            $gambar = $request->file('gambar')
                ->store('ekstrakurikuler', 'public');
        }

        // Update data ke database
        $ekstrakurikuler->update([
            'nama_ekskul' => $request->nama_ekskul,
            'slug' => $slug,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    // --- PROSES HAPUS EKSTRAKURIKULER ---
    public function destroy($id)
    {
        // Dekripsi ID
        try {
            $idEkskul = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $ekstrakurikuler = Ekstrakurikuler::findOrFail($idEkskul);

        // Hapus file gambar dari folder storage jika ekskul ini memiliki gambar
        if ($ekstrakurikuler->gambar) {
            Storage::disk('public')->delete($ekstrakurikuler->gambar);
        }

        // Hapus data ekskul dari database
        $ekstrakurikuler->delete();

        return redirect()
            ->route('admin.ekstrakurikuler')
            ->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }

    // ==========================================
    // --- KHUSUS HALAMAN PUBLIK / LANDING PAGE ---
    // ==========================================

    // Tampilkan seluruh daftar ekstrakurikuler untuk pengunjung umum
    public function publicIndex()
    {
        $ekstrakurikulers = Ekstrakurikuler::orderBy(
            'id_ekskul',
            'desc'
        )->get();

        return view(
            'landing.ekstrakurikuler.index',
            compact('ekstrakurikulers')
        );
    }

    // Tampilkan detail ekstrakurikuler berdasarkan slug
    public function publicShow($slug)
    {
        $ekstrakurikuler = Ekstrakurikuler::where(
            'slug',
            $slug
        )->firstOrFail();

        return view(
            'landing.ekstrakurikuler.show',
            compact('ekstrakurikuler')
        );
    }
}