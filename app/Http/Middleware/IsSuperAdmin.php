<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah user yang sedang login adalah superadmin
        if (!auth()->check() || !auth()->user()->is_superadmin) {
            abort(403, 'Akses hanya untuk Superadmin.');
        }

        // Jika lolos pengecekan, lanjutkan request
        return $next($request);
    }
}
