<?php namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class ValidacionRutas
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rol = null)
    {

        if (!Session::has('USUARIO') and !Session::has('ADMIN')) {
            return redirect('/');
        } else if ($rol == null) {
            return $next($request);
        } else if (!Session::get('USUARIO')->hasRol($rol)) {
            App::abort(403, 'Access denied');
        }
        return $next($request);
    }

}
