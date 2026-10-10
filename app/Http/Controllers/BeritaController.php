<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk kelola hapus/simpan file foto
use Illuminate\Support\Facades\Crypt;   // Untuk enkripsi & dekripsi ID di URL
use Illuminate\Support\Str;              // Untuk membuat slug otomatis dari judul

class BeritaController extends Controller
{
    // --- HALAMAN UTAMA ADMIN BERITA ---
    public function index(Request $request)
    {
        // Ambil data berita beserta pembuatnya (relasi user)
        $query = Berita::with('user');

        // Filter berdasarkan pencarian judul berita (jika ada)
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status (Draft/Public) jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Urutkan dari tanggal berita paling terbaru
        $beritas = $query
            ->orderBy('tanggal', 'desc')
            ->get();

        // Enkripsi ID setiap berita agar aman dari keisengan ubah URL
        foreach ($beritas as $berita) {
            $berita->encrypted_id = Crypt::encrypt($berita->id_berita);
        }

        return view('admin.berita.index', compact('beritas'));
    }

    // --- FORM TAMBAH BERITA ---
    public function create()
    {
        return view('admin.berita.create');
    }

    // --- PROSES SIMPAN BERITA BARU ---
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Draft,Public',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Foto opsional, max 2MB
        ]);

        $foto = null;

        // Jika ada upload foto, simpan ke folder 'storage/app/public/berita'
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('berita', 'public');
        }

        // Buat slug otomatis dari judul (Contoh: "Berita Hari Ini" -> "berita-hari-ini")
        $slug = Str::slug($request->judul);
        $slugAsli = $slug;
        $counter = 1;

        // Jika slug sudah ada di database, tambahkan angka dibelakangnya (misal: "berita-hari-ini-1")
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        // Simpan data berita ke database
        Berita::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'foto' => $foto,
            'status' => $request->status,
            'id_user' => auth()->user()->id_user, // Mengambil ID pembuat dari user yang lagi login
        ]);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    // --- FORM EDIT BERITA ---
    public function edit($id)
    {
        // Dekripsi ID dari URL
        try {
            $idBerita = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // Tampilkan 404 jika ID acak-acakan / tidak valid
        }

        $berita = Berita::findOrFail($idBerita);

        return view('admin.berita.edit', compact('berita'));
    }

    // --- PROSES UPDATE BERITA ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID
        try {
            $idBerita = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $berita = Berita::findOrFail($idBerita);

        // Validasi input
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Draft,Public',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = $berita->foto; // Ambil path foto lama dulu

        // Jika user mengunggah foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage kalau sebelumnya ada
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }

            // Simpan foto yang baru
            $foto = $request->file('foto')->store('berita', 'public');
        }

        // Buat ulang slug jika judul berubah
        $slug = Str::slug($request->judul);
        $slugAsli = $slug;
        $counter = 1;

        // Cek duplikasi slug, tapi abaikan untuk berita yang sedang diedit ini
        while (
            Berita::where('slug', $slug)
                ->where('id_berita', '!=', $berita->id_berita)
                ->exists()
        ) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        // Update data ke database
        $berita->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'foto' => $foto,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    // --- PROSES HAPUS BERITA ---
    public function destroy($id)
    {
        // Dekripsi ID
        try {
            $idBerita = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $berita = Berita::findOrFail($idBerita);

        // Hapus file foto dari folder storage jika beritanya punya foto
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }

        // Hapus data berita dari database
        $berita->delete();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }

    // ==========================================
    // --- KHUSUS HALAMAN PUBLIK / LANDING PAGE ---
    // ==========================================

    // Tampilkan daftar berita di web pengunjung (Hanya yang statusnya 'Public')
    public function publicIndex()
    {
        $beritas = Berita::where('status', 'Public')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('landing.berita.index', compact('beritas'));
    }

    // Tampilkan detail isi berita berdasarkan slug (Hanya yang statusnya 'Public')
    public function publicShow($slug)
    {
        $berita = Berita::where('status', 'Public')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('landing.berita.show', compact('berita'));
    }
}