<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            // Redirect to homepage if not authenticated
            return redirect()->route('homepage')->with('error', 'You must be logged in to access this page.');
        }

        // Allow the request to proceed if authenticated
        return $next($request);
    }
}
