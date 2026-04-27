<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if ((auth()->user()->role ?? null) !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Access restricted. Redirected to your dashboard.');
        }

        return $next($request);
    }
}