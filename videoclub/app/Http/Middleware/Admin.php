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
        if(session('user')){
            foreach(session('user') as $user){
                if($user->role !== 'admin'){
                    auth()->logout();
                    return redirect('/')->with('error', 'No tienes permiso para acceder aquí.');
                }

            }
        }
        return $next($request);
    }
}
