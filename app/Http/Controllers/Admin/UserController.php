<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt; // Untuk enkripsi ID supaya aman di URL

class UserController extends Controller
{
    // --- HALAMAN UTAMA / DAFTAR USER ---
    public function index(Request $request)
    {
        $users = User::query();

        // Jika user mengetikkan sesuatu di kolom cari (search)
        if ($request->filled('search')) {
            $users->where(function ($query) use ($request) {
                // Cari berdasarkan username atau role yang mirip
                $query->where('username', 'like', '%' . $request->search . '%')
                      ->orWhere('role', 'like', '%' . $request->search . '%');
            });
        }

        // Urutkan dari ID user yang terbaru (paling baru dibuat)
        $users = $users->latest('id_user')->get();

        // Enkripsi ID setiap user agar tidak terlihat ID aslinya di URL (keamanan tambahan)
        foreach ($users as $user) {
            $user->encrypted_id = Crypt::encrypt($user->id_user);
        }

        // Tampilkan halaman daftar user dan kirimkan data users-nya
        return view('admin.user.index', compact('users'));
    }

    // --- TAMPILKAN FORM TAMBAH USER ---
    public function create()
    {
        return view('admin.user.create');
    }

    // --- PROSES SIMPAN USER BARU ---
    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username', // Wajib diisi, maksimal 50 karakter, tidak boleh sama dengan username lain
            'password' => 'required|string|min:6',                         // Wajib diisi, minimal 6 karakter
            'role' => 'required|in:Admin,Operator',                        // Wajib diisi, pilihannya cuma Admin atau Operator
        ]);

        // Simpan data ke database
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password di-hash biar tersimpan acak & aman di database
            'role' => $request->role,
        ]);

        // Kembalikan ke halaman daftar user dengan pesan sukses
        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // --- TAMPILKAN FORM EDIT USER ---
    public function edit($id)
    {
        // Coba dekripsi/pecahkan ID dari URL
        try {
            $idUser = Crypt::decrypt($id);
        } catch (\Exception $e) {
            // Kalau ID tidak valid / acak-acakan (sengaja diubah user), tampilkan halaman Error 404
            abort(404);
        }

        // Cari data user berdasarkan ID asli. Kalau tidak ketemu, tampilkan Error 404
        $user = User::findOrFail($idUser);

        return view('admin.user.edit', compact('user'));
    }

    // --- PROSES UPDATE DATA USER ---
    public function update(Request $request, $id)
    {
        // Dekripsi ID dari URL
        try {
            $idUser = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $user = User::findOrFail($idUser);

        // Validasi inputan
        $request->validate([
            // Username unik, tapi abaikan untuk ID user ini sendiri (biar kalau tidak diubah tidak kena eror unique)
            'username' => 'required|string|max:50|unique:users,username,' . $user->id_user . ',id_user',
            'role' => 'required|in:Admin,Operator',
            'password' => 'nullable|string|min:6', // Boleh dikosongkan kalau tidak ingin ganti password
        ]);

        // Siapkan data yang pasti diubah
        $data = [
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Jika kolom password diisi, enkripsi password baru dan masukkan ke array data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update data user di database
        $user->update($data);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    // --- TAMPILKAN HALAMAN PROFIL AKUN SENDIRI ---
    public function profile()
    {
        return view('admin.profile');
    }

    // --- PROSES UPDATE PROFIL AKUN SENDIRI ---
    public function updateProfile(Request $request)
    {
        // Ambil data user yang sedang login saat ini
        $user = auth()->user();

        // Validasi input
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:6|confirmed', // 'confirmed' artinya harus cocok dengan inputan konfirmasi password
        ]);

        $user->username = $request->username;

        // Jika password diisi, update password-nya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan profil
        $user->save();

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    // --- PROSES HAPUS USER ---
    public function destroy($id)
    {
        // Dekripsi ID dari URL
        try {
            $idUser = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $user = User::findOrFail($idUser);

        // Hapus user dari database
        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}