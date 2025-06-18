<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::check()
            ? match (Auth::user()->role->nama) {
                Role::MAHASISWA => redirect()->intended(route('mahasiswa.dashboard')),
                Role::KEPALA_PRODI => redirect()->intended(route('kaprodi.dashboard')),
                Role::BAAK => redirect()->intended(route('baak.dashboard')),
                Role::UPAPKK => redirect()->intended(route('upapkk.dashboard')),
                default => abort(401, 'Unauthorized')
            }
            : $next($request);
    }
}
