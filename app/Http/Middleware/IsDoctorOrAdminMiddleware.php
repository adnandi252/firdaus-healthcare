<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDoctorOrAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna adalah dokter atau admin
        if (auth()->check() && (auth()->user()->role == 'doctor' || auth()->user()->role == 'patient')) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
