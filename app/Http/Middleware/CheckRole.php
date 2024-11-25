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
        $user = Auth::user();

        // Pastikan user sudah login dan memiliki relasi employee
        if (!$user || !$user->employee) {
            abort(403, 'Unauthorized or employee data not found.');
        }

        // Periksa posisi user
        if (!in_array($user->position, $positions)) {
            abort(403, 'You do not have the required role. Please contact your administrator.');
        }

        return $next($request);
    }
}