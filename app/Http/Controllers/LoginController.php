<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mengurusi proses login & logout pengguna

class LoginController extends Controller
{
    // --- TAMPILKAN HALAMAN FORM LOGIN ---
    public function showLogin()
    {
        return view('auth.login');
    }

    // --- PROSES AUTENTIKASI / PROSES LOGIN ---
    public function login(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            // Pesan error kustom jika form kosong
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Cek apakah username & password cocok dengan data di database
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {

            // Buat ulang ID sesi (Session ID) baru agar aman dari serangan "Session Fixation"
            $request->session()->regenerate();

            // Jika berhasil login, lempar pengguna ke halaman Dashboard Admin
            return redirect()->route('admin.dashboard');
        }

        // 3. Jika gagal login (username/password salah)
        // Kembalikan ke halaman login sambil membawa isi username tadi (biar user tidak perlu ngetik ulang username)
        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah.');
    }

    // --- PROSES LOGOUT ---
    public function logout(Request $request)
    {
        // Keluar dari sistem / hapus status autentikasi user
        Auth::logout();

        // Hapus dan batalkan sesi user saat ini
        $request->session()->invalidate();

        // Buat ulang token CSRF baru agar aman dari penyalahgunaan form
        $request->session()->regenerateToken();

        // Kembalikan ke halaman form login
        return redirect()->route('login');
    }
}