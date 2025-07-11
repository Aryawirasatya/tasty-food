<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();
        if ($user && $user->isSuperAdmin()){
            return $next($request);
        }

        if (!$user || !$user->role || !$user->role->permissions->contains('name', $permission)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}