<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login atau bukan admin, tolak
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
