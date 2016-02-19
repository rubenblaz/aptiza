<?php namespace App\Http\Middleware;

use Closure;
use App\Modelo\Usuario;
use Session;

class AutenticarUsuario {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
       
        if ($request->input('email') != null) {

            $usuario = new Usuario($request->input('email'), $request->input('pass'));
            if (($usuariosession = $usuario->esValido())) {
                Session::put('USUARIO', $usuariosession);
            } else {
                return redirect('errorlogin');
            }
        }
        return $next($request);
    }
}
