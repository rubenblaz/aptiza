<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class TipoInicioSesion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
            if(Session::has('ADMIN')){
                Session::put('USUARIO',Session::pull('ADMIN'));
            }
            Session::get('USUARIO')->usarComoAdmin($request->input('administrador'));
        
        return $next($request);
    }
}
