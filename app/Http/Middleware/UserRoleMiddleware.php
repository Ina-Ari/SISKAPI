<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (!$user || !$user->role) {
            abort(403);
        }

        $userRole = strtolower($user->role->nama);

        $allowedRoles = collect($roles)
            ->map(fn($role) => strtolower($this->mapAlias($role)));

        if (!$allowedRoles->contains($userRole)) {
            abort(403);
        }

        return $next($request);
    }

    protected function mapAlias(string $role): string
    {
        return match (strtolower($role)) {
            'kaprodi' => Role::KEPALA_PRODI,
            default => $role,
        };
    }
}
