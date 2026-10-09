<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDentist
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        if (!$user || $user->email !== config('dentist.email')) {
            abort(403, 'No tienes permiso para acceder a este panel.');
        }

        return $next($request);
    }
}