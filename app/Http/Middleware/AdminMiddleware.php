<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    // Fungsi ini bertindak sebagai "satpam" pemberhentian sebelum request masuk ke Controller
    public function handle(Request $request, Closure $next): Response
    {
        // 1. CEK STATUS LOGIN
        // Kalau pengguna belum login sama sekali, tendang / arahkan ke halaman login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. CEK HAK AKSES (ROLE)
        // Kalau pengguna sudah login TAPI role-nya bukan 'Admin' dan bukan 'Operator',
        // hentikan request dan tampilkan error 403 (Akses Ditolak)
        if (!in_array(auth()->user()->role, ['Admin', 'Operator'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // 3. LOLOS CEK
        // Jika lolos semua pemeriksaan di atas, izinkan pengguna melanjutkan ke halaman yang dituju
        return $next($request);
    }
}