<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk kelola hapus/simpan file foto & video
use Illuminate\Support\Facades\Crypt;   // Untuk enkripsi & dekripsi ID di URL
use Illuminate\Support\Str;              // Untuk membuat slug otomatis dari judul galeri

class GaleriController extends Controller
{
    // --- HALAMAN UTAMA ADMIN GALERI ---
    public function index(Request $request)
    {
        $query = Galeri::query();

        // Fitur pencarian: cari berdasarkan judul atau keterangan
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori (Foto atau Video)
        if (
            $request->filled('kategori') &&
            in_array($request->kategori, ['Foto', 'Video'])
        ) {
            $query->where('kategori', $request->kategori);
        }

        // Urutkan galeri berdasarkan tanggal terbaru
        $galeris = $query
            ->latest('tanggal')
            ->get();

        // Enkripsi ID galeri agar tidak berupa angka biasa di URL
        foreach ($galeris as $galeri) {
            $galeri->encrypted_id = Crypt::encrypt(
                $galeri->id_galeri
            );
        }

        return view(
            'admin.galeri.index',
            compact('galeris')
        );
    }

    // --- FORM TAMBAH GALERI ---
    public function create()
    {
        return view('admin.galeri.create');
    }

    // --- PROSES SIMPAN GALERI BARU ---
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'judul' => 'required|max:50',
            'keterangan' => 'nullable',
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480', // Wajib unggah file foto/video, maksimal 20MB
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        // Buat slug otomatis dari judul (misal: "Kegiatan Upacara" -> "kegiatan-upacara")
        $slug = Str::slug($request->judul);
        $slugAsli = $slug;
        $counter = 1;

        // Jika slug sudah ada di database, tambahkan angka dibelakangnya
        while (Galeri::where('slug', $slug)->exists()) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        // Simpan file foto/video ke folder 'storage/app/public/galeri'
        $file = $request->file('file')
            ->store('galeri', 'public');

        // Simpan data ke database
        Galeri::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'keterangan' => $request->keterangan,
            'file' => $file,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    // --- FORM EDIT GALERI ---
    public function edit($id)
    {
        // Dekripsi ID dari URL
        try {
            $idGaleri = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // Jika ID tidak valid, tampilkan error 404
        }

        $galeri = Galeri::findOrFail($idGaleri);

        return view(
            'admin.galeri.edit',
            compact('galeri')
        );
    }

    // --- PROSES UPDATE DATA GALERI ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID
        try {
            $idGaleri = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $galeri = Galeri::findOrFail($idGaleri);

        // Validasi inputan
        $request->validate([
            'judul' => 'required|max:50',
            'keterangan' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480', // File opsional saat update
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
        ]);

        // Buat ulang slug jika judul berubah
        $slug = Str::slug($request->judul);
        $slugAsli = $slug;
        $counter = 1;

        // Cek duplikasi slug (abaikan untuk data galeri yang sedang diedit)
        while (
            Galeri::where('slug', $slug)
                ->where('id_galeri', '!=', $galeri->id_galeri)
                ->exists()
        ) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        $file = $galeri->file; // Ambil path file lama

        // Jika user memilih untuk mengunggah file baru
        if ($request->hasFile('file')) {
            // Hapus file lama dari storage jika ada
            if ($file) {
                Storage::disk('public')->delete($file);
            }

            // Simpan file baru
            $file = $request->file('file')
                ->store('galeri', 'public');
        }

        // Update data ke database
        $galeri->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'keterangan' => $request->keterangan,
            'file' => $file,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    // --- PROSES HAPUS GALERI ---
    public function destroy($id)
    {
        // Dekripsi ID
        try {
            $idGaleri = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $galeri = Galeri::findOrFail($idGaleri);

        // Hapus file foto/video dari folder storage jika ada
        if ($galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        // Hapus data galeri dari database
        $galeri->delete();

        return redirect()
            ->route('admin.galeri')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    // ==========================================
    // --- KHUSUS HALAMAN PUBLIK / LANDING PAGE ---
    // ==========================================

    // Tampilkan daftar seluruh galeri untuk pengunjung umum
    public function publicIndex()
    {
        $galeris = Galeri::orderBy(
            'tanggal',
            'desc'
        )->get();

        return view(
            'landing.galeri.index',
            compact('galeris')
        );
    }

    // Tampilkan detail galeri berdasarkan slug
    public function publicShow($slug)
    {
        $galeri = Galeri::where(
            'slug',
            $slug
        )->firstOrFail();

        return view(
            'landing.galeri.show',
            compact('galeri')
        );
    }
}