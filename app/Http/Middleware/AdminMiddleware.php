<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (!auth()->check() || (auth()->user()->role->name != 'Admin')) {
            // İstifadəçi Admin deyilsə, /home səhifəsinə yönləndir
            return redirect('/home');
        }

        // İstifadəçi Admin-dirsə, növbəti middleware-a davam et
        return $next($request);
    }
}
