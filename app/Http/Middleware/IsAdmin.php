<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{   

        /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && ($user->isAdmin() || $user->isSuperAdmin())) {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Anda bukan admin.');
    }
}
