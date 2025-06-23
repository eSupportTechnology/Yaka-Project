<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Handle web requests
        if (Auth::user() && Auth::user()->isAdmin()) {
            return $next($request);
        }
        
        // Handle API requests
        if ($request->expectsJson()) {
            if (Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->roles === 'admin') {
                return $next($request);
            }
            
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access',
            ], 403);
        }
    
        return redirect()->route('user.dashboard')->with('error', 'Unauthorized access');
    }
}
