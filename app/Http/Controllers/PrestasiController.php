<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk menghapus/menyimpan file foto
use Illuminate\Support\Facades\Crypt;   // Untuk enkripsi & dekripsi ID di URL
use Illuminate\Support\Str;              // Untuk membuat slug otomatis dari nama prestasi

class PrestasiController extends Controller
{
    // --- HALAMAN UTAMA ADMIN PRESTASI ---
    public function index(Request $request)
    {
        // Ambil data prestasi, urutkan berdasarkan tahun ajaran terbaru
        $query = Prestasi::latest('tahun_ajaran');

        // Fitur pencarian: cari berdasarkan nama prestasi, deskripsi, atau tahun ajaran
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_prestasi', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                    ->orWhere('tahun_ajaran', 'like', '%' . $request->search . '%');
            });
        }

        $prestasis = $query->get();

        // Enkripsi ID prestasi agar aman dan acak saat dipasang di tombol aksi
        foreach ($prestasis as $prestasi) {
            $prestasi->encrypted_id = Crypt::encrypt(
                $prestasi->id_prestasi
            );
        }

        return view(
            'admin.prestasi.index',
            compact('prestasis')
        );
    }

    // --- FORM TAMBAH PRESTASI ---
    public function create()
    {
        return view('admin.prestasi.create');
    }

    // --- PROSES SIMPAN PRESTASI BARU ---
    public function store(Request $request)
    {
        // Validasi inputan form
        $data = $request->validate([
            'nama_prestasi' => 'required|max:100',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Opsional, maks 2MB
            'tahun_ajaran' => 'required|digits:4',                       // Wajib 4 digit angka (misal: 2024)
        ]);

        // Buat slug otomatis dari nama prestasi (misal: "Juara 1 Futsal" -> "juara-1-futsal")
        $slug = Str::slug($request->nama_prestasi);
        $slugAsli = $slug;
        $counter = 1;

        // Cek jika slug sudah ada, beri tambahan angka di belakangnya agar unik
        while (Prestasi::where('slug', $slug)->exists()) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        // Jika ada unggahan foto, simpan ke folder 'storage/app/public/prestasi'
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('prestasi', 'public');
        }

        // Simpan seluruh data ke database
        Prestasi::create($data);

        return redirect()
            ->route('admin.prestasi')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    // --- FORM EDIT PRESTASI ---
    public function edit($id)
    {
        // Dekripsi ID dari URL
        try {
            $idPrestasi = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // Tampilkan 404 jika ID acak-acakan / diubah paksa
        }

        $prestasi = Prestasi::findOrFail($idPrestasi);

        return view(
            'admin.prestasi.edit',
            compact('prestasi')
        );
    }

    // --- PROSES UPDATE PRESTASI ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID
        try {
            $idPrestasi = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $prestasi = Prestasi::findOrFail($idPrestasi);

        // Validasi inputan
        $data = $request->validate([
            'nama_prestasi' => 'required|max:100',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tahun_ajaran' => 'required|digits:4',
        ]);

        // Buat ulang slug jika nama prestasi diubah
        $slug = Str::slug($request->nama_prestasi);
        $slugAsli = $slug;
        $counter = 1;

        // Pastikan slug unik (abaikan untuk data prestasi yang sedang diedit ini)
        while (
            Prestasi::where('slug', $slug)
                ->where('id_prestasi', '!=', $prestasi->id_prestasi)
                ->exists()
        ) {
            $slug = $slugAsli . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        // Jika user memilih untuk mengunggah foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama dari storage jika sebelumnya ada
            if ($prestasi->foto) {
                Storage::disk('public')->delete($prestasi->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')
                ->store('prestasi', 'public');
        }

        // Update data di database
        $prestasi->update($data);

        return redirect()
            ->route('admin.prestasi')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    // --- PROSES HAPUS PRESTASI ---
    public function destroy($id)
    {
        // Dekripsi ID
        try {
            $idPrestasi = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $prestasi = Prestasi::findOrFail($idPrestasi);

        // Hapus file foto dari folder storage jika prestasi ini memiliki foto
        if ($prestasi->foto) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        // Hapus data prestasi dari database
        $prestasi->delete();

        return redirect()
            ->route('admin.prestasi')
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    // ==========================================
    // --- KHUSUS HALAMAN PUBLIK / LANDING PAGE ---
    // ==========================================

    // Tampilkan daftar semua prestasi untuk pengunjung umum (diurutkan dari tahun ajaran terbaru)
    public function publicIndex()
    {
        $prestasis = Prestasi::orderBy(
            'tahun_ajaran',
            'desc'
        )->get();

        return view(
            'landing.prestasi.index',
            compact('prestasis')
        );
    }

    // Tampilkan detail prestasi berdasarkan slug di halaman publik
    public function publicShow($slug)
    {
        $prestasi = Prestasi::where('slug', $slug)
            ->firstOrFail();

        return view(
            'landing.prestasi.show',
            compact('prestasi')
        );
    }
}