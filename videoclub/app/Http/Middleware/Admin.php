<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user()->role);
        if(Auth::user()->role === 'free'){
            abort(403, 'Unauthorized');
            return redirect('/login');

        }

        // if(!Auth::guard('admin')->check()){
        //     return redirect('/login');
        // }
        return $next($request);
    }
}
