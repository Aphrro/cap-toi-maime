<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsMember
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bypass pour environnement local (dev)
        if (app()->environment('local')) {
            return $next($request);
        }

        if (!auth()->check()) {
            return redirect()->route('member.gate');
        }

        // Bypass pour compte dev/admin
        $devEmails = ['deepmock@gmail.com'];
        if (in_array(auth()->user()->email, $devEmails)) {
            return $next($request);
        }

        if (auth()->user()->member_status !== 'approved') {
            return redirect()->route('member.pending');
        }

        return $next($request);
    }
}
