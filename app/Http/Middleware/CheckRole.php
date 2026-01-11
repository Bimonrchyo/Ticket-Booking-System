<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (! Auth::check()) {
            return redirect('/login');
        }

        // 2. Ambil role user saat ini
        $userRole = Auth::user()->role;

        // 3. Cek apakah role user ada dalam daftar role yang diizinkan di route
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Jika tidak punya akses, arahkan kembali sesuai role masing-masing
        if ($userRole == 'superadmin')
            return redirect('/super/dashboard');
        if ($userRole == 'admin')
            return redirect('/admin/dashboard');

        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
