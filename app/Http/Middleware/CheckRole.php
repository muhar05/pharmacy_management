<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$positions)
    {
        // Cek jika user belum login
        if (!$user = Auth::user()) {
            abort(403, 'Unauthorized data not found.');
        }

        // Ambil posisi user setelah login
        $userPosition = $user->position;

        // Periksa posisi user
        if (!in_array($userPosition, $positions)) {
            abort(403, 'You do not have the required role. Please contact your administrator.');
        }

        return $next($request);
    }
}