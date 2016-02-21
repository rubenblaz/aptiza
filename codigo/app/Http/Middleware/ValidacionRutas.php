<?php namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class ValidacionRutas {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rol) {
        
        if (!Session::has('USUARIO') and Session::get('USUARIO')->getRol() != $rol ) {
            return redirect('/');
        }else if(Session::get('USUARIO')->getRol() != $rol){
          App::abort(403, 'Access denied');
        }
        return $next($request);
    }

}
