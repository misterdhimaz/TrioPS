<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan kolom is_admin bernilai true (1)
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Jika bukan admin, kembalikan ke beranda dengan pesan error atau abort 403
        abort(403, 'Akses Ditolak. Anda bukan Admin.');
    }
}
