<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt; // Untuk enkripsi & dekripsi ID di URL agar lebih aman

class SiswaController extends Controller
{
    // --- HALAMAN UTAMA / DAFTAR SISWA ---
    public function index(Request $request)
    {
        $query = Siswa::query();

        // 1. Pencarian berdasarkan nama siswa atau NISN
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', '%' . $search . '%')
                  ->orWhere('nisn', 'like', '%' . $search . '%');
            });
        }

        // 2. Filter berdasarkan jenis kelamin (Laki-Laki / Perempuan)
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // 3. Filter berdasarkan tahun masuk
        if ($request->filled('tahun_masuk')) {
            $query->where('tahun_masuk', $request->tahun_masuk);
        }

        // Ambil data terbaru, bagi per 10 data per halaman (pagination),
        // dan pertahankan keyword pencarian/filter di URL saat pindah halaman
        $siswas = $query
            ->orderBy('id_siswa', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Enkripsi ID setiap siswa agar aman dan acak saat dipakai di tombol edit/hapus
        foreach ($siswas as $siswa) {
            $siswa->encrypted_id = Crypt::encrypt($siswa->id_siswa);
        }

        return view('admin.siswa.index', compact('siswas'));
    }

    // --- FORM TAMBAH SISWA ---
    public function create()
    {
        return view('admin.siswa.create');
    }

    // --- PROSES SIMPAN DATA SISWA BARU ---
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'nisn'          => 'required|string|max:10',
            'nama_siswa'    => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|integer',
        ]);

        // Simpan data siswa baru ke database
        Siswa::create([
            'nisn'          => $request->nisn,
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk'   => $request->tahun_masuk,
        ]);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // --- FORM EDIT SISWA ---
    public function edit($id)
    {
        // Dekripsi ID dari URL
        try {
            $idSiswa = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // Tampilkan 404 jika ID acak-acakan / tidak valid
        }

        $siswa = Siswa::findOrFail($idSiswa);

        return view('admin.siswa.edit', compact('siswa'));
    }

    // --- PROSES UPDATE DATA SISWA ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID dari URL
        try {
            $idSiswa = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $siswa = Siswa::findOrFail($idSiswa);

        // Validasi inputan
        $request->validate([
            'nisn'          => 'required|string|max:10',
            'nama_siswa'    => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk'   => 'required|integer',
        ]);

        // Update data siswa di database
        $siswa->update([
            'nisn'          => $request->nisn,
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk'   => $request->tahun_masuk,
        ]);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    // --- PROSES HAPUS SISWA ---
    public function destroy($id)
    {
        // Dekripsi ID dari URL
        try {
            $idSiswa = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $siswa = Siswa::findOrFail($idSiswa);

        // Hapus data siswa dari database
        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}