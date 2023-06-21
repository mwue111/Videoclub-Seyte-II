<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    return $next($request)
      //Url a la que se le dará acceso en las peticiones
      ->header("Access-Control-Allow-Origin", "http://localhost:4200")
      //Métodos que a los que se da acceso
      ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
      //Headers de la petición
      ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");

    // $response = $next($request)
    // ->header("Access-Control-Allow-Origin", "http://localhost:4200")
    // ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
    // ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");

    // if ($request->isMethod('OPTIONS')) {
    //     $response->header("Access-Control-Allow-Credentials", "true");
    // }

    // return $response;
  }
}
