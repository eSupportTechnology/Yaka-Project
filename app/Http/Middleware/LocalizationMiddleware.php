<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;  
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 

    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale', 'en'); // Default to 'en' if no language is selected
        App::setLocale($locale);  
        return $next($request);
    }
    



}
