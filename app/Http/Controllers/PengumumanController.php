<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt; // Untuk enkripsi & dekripsi ID di URL agar lebih aman

class PengumumanController extends Controller
{
    // --- HALAMAN UTAMA ADMIN PENGUMUMAN ---
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        // Fitur pencarian: cari berdasarkan judul, isi pengumuman, atau statusnya
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('isi', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        // Urutkan pengumuman berdasarkan tanggal terbaru
        $pengumumans = $query
            ->latest('tanggal')
            ->get();

        // Enkripsi ID pengumuman agar acak/aman saat dipasang di link tombol
        foreach ($pengumumans as $pengumuman) {
            $pengumuman->encrypted_id = Crypt::encrypt(
                $pengumuman->id_pengumuman
            );
        }

        return view(
            'admin.pengumuman.index',
            compact('pengumumans')
        );
    }

    // --- FORM TAMBAH PENGUMUMAN ---
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    // --- PROSES SIMPAN PENGUMUMAN BARU ---
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Publish,Draft',
        ]);

        // Simpan data pengumuman ke database
        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'id_user' => 1, // Default diset ke user ID 1 (Tips: Bisa diganti auth()->user()->id_user)
        ]);

        return redirect()
            ->route('admin.pengumuman')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    // --- FORM EDIT PENGUMUMAN ---
    public function edit($id)
    {
        // Dekripsi ID dari URL
        try {
            $idPengumuman = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404); // Tampilkan error 404 kalau ID tidak valid / diotak-atik
        }

        $pengumuman = Pengumuman::findOrFail($idPengumuman);

        return view(
            'admin.pengumuman.edit',
            compact('pengumuman')
        );
    }

    // --- PROSES UPDATE PENGUMUMAN ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID
        try {
            $idPengumuman = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $pengumuman = Pengumuman::findOrFail($idPengumuman);

        // Validasi inputan
        $request->validate([
            'judul' => 'required|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:Publish,Draft',
        ]);

        // Update data pengumuman di database
        $pengumuman->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.pengumuman')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    // --- PROSES HAPUS PENGUMUMAN ---
    public function destroy($id)
    {
        // Dekripsi ID
        try {
            $idPengumuman = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $pengumuman = Pengumuman::findOrFail($idPengumuman);

        // Hapus pengumuman dari database
        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    // ==========================================
    // --- KHUSUS HALAMAN PUBLIK / LANDING PAGE ---
    // ==========================================

    // Tampilkan daftar semua pengumuman untuk pengunjung umum
    public function publicIndex()
    {
        $pengumumans = Pengumuman::orderBy(
            'tanggal',
            'desc'
        )->get();

        // Enkripsi ID agar link detail di halaman publik aman
        foreach ($pengumumans as $pengumuman) {
            $pengumuman->encrypted_id = Crypt::encrypt(
                $pengumuman->id_pengumuman
            );
        }

        return view(
            'landing.pengumuman.index',
            compact('pengumumans')
        );
    }

    // Tampilkan detail isi pengumuman tertentu berdasarkan ID terenkripsi
    public function publicShow($id)
    {
        // Dekripsi ID
        try {
            $idPengumuman = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $pengumuman = Pengumuman::findOrFail($idPengumuman);

        return view(
            'landing.pengumuman.show',
            compact('pengumuman')
        );
    }
}