<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk menghapus/menyimpan file foto guru
use Illuminate\Support\Facades\Crypt;   // Untuk enkripsi & dekripsi ID di URL

class GuruController extends Controller
{
    // --- HALAMAN UTAMA ADMIN GURU ---
    public function index()
    {
        $query = Guru::query();

        // Fitur pencarian: cari berdasarkan nama, NIP, atau mata pelajaran
        if (request('search')) {
            $search = request('search');

            $query->where(function ($q) use ($search) {
                $q->where('nama_guru', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('mapel', 'like', '%' . $search . '%');
            });
        }

        // Urutkan dari data guru yang paling baru ditambahkan
        $gurus = $query
            ->orderBy('id_guru', 'desc')
            ->get();

        // Enkripsi ID guru agar aman dan tidak berupa angka asli di URL
        foreach ($gurus as $guru) {
            $guru->encrypted_id = Crypt::encrypt($guru->id_guru);
        }

        return view('admin.guru.index', compact('gurus'));
    }

    // --- FORM TAMBAH GURU ---
    public function create()
    {
        return view('admin.guru.create');
    }

    // --- PROSES SIMPAN GURU BARU ---
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip' => 'nullable|string|max:15',
            'mapel' => 'nullable|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Opsional, maks 2MB
        ]);

        $namaFoto = null;

        // Jika ada foto yang diunggah, simpan dengan nama custom (timestamp + nama asli file)
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $namaFoto = time() . '_' . $file->getClientOriginalName();

            // Simpan file foto ke folder 'storage/app/public/guru'
            $file->storeAs('guru', $namaFoto, 'public');
        }

        // Simpan data guru ke database
        Guru::create([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => $namaFoto,
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan!');
    }

    // --- FORM EDIT GURU ---
    public function edit($id)
    {
        // Dekripsi ID dari URL
        try {
            $idGuru = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // Tampilkan 404 jika ID tidak valid
        }

        $guru = Guru::findOrFail($idGuru);

        return view('admin.guru.edit', compact('guru'));
    }

    // --- PROSES UPDATE DATA GURU ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID
        try {
            $idGuru = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $guru = Guru::findOrFail($idGuru);

        // Validasi inputan
        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip' => 'nullable|string|max:15',
            'mapel' => 'nullable|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $namaFoto = $guru->foto; // Ambil nama foto lama dulu

        // Jika user mengunggah foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama dari storage jika filenya ada
            if (
                $guru->foto &&
                Storage::disk('public')->exists('guru/' . $guru->foto)
            ) {
                Storage::disk('public')->delete('guru/' . $guru->foto);
            }

            // Simpan foto baru dengan nama custom
            $file = $request->file('foto');

            $namaFoto = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('guru', $namaFoto, 'public');
        }

        // Update data guru di database
        $guru->update([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => $namaFoto,
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diperbarui!');
    }

    // --- PROSES HAPUS GURU ---
    public function destroy($id)
    {
        // Dekripsi ID
        try {
            $idGuru = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $guru = Guru::findOrFail($idGuru);

        // Hapus foto guru dari folder storage jika filenya ada
        if (
            $guru->foto &&
            Storage::disk('public')->exists('guru/' . $guru->foto)
        ) {
            Storage::disk('public')->delete('guru/' . $guru->foto);
        }

        // Hapus data guru dari database
        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus!');
    }

    // ==========================================
    // --- KHUSUS HALAMAN PUBLIK / LANDING PAGE ---
    // ==========================================

    // Tampilkan daftar semua guru untuk pengunjung umum
    public function publicIndex()
    {
        // Ambil data profil sekolah untuk menampilkan nama sekolah di judul/header
        $profile = \App\Models\Profile::first();

        // Jika nama sekolah di database kosong, pakai fallback 'SMK YPC Tasikmalaya'
        $namaSekolah = $profile->nama_sekolah ?? 'SMK YPC Tasikmalaya';

        $gurus = Guru::orderBy('id_guru', 'desc')->get();

        // Enkripsi ID agar aman saat dipasang di tombol detail
        foreach ($gurus as $guru) {
            $guru->encrypted_id = Crypt::encrypt($guru->id_guru);
        }

        return view('landing.guru.index', compact(
            'gurus',
            'namaSekolah'
        ));
    }

    // Tampilkan detail profil guru tertentu beserta rekomendasi guru lainnya
    public function publicShow($id)
    {
        // Dekripsi ID
        try {
            $idGuru = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $guru = Guru::findOrFail($idGuru);

        // Ambil 4 guru lainnya (selain guru yang sedang dilihat) untuk rekomendasi/rekomendasi samping
        $guruLainnya = Guru::where('id_guru', '!=', $idGuru)
            ->orderBy('id_guru', 'desc')
            ->take(4)
            ->get();

        foreach ($guruLainnya as $guruItem) {
            $guruItem->encrypted_id = Crypt::encrypt($guruItem->id_guru);
        }

        return view('landing.guru.show', compact(
            'guru',
            'guruLainnya'
        ));
    }
}