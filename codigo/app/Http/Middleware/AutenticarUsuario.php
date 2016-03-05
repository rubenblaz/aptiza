<?php namespace App\Http\Middleware;

use Closure;
use App\Modelo\Usuario;
use Session;
use Request;

class AutenticarUsuario extends \App\Http\Controllers\Controller {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
            
            $this->validate($request,['email' => 'required','pass' => 'required']);
       
            $usuario = new Usuario($request->input('email'), $request->input('pass'));
            
            if(!($usuariosession = $usuario->esValido())) {
                
                return redirect('errorlogin');
                
            }else if($usuariosession->tieneDobleRol()) {
                
                Session::put('ADMIN', $usuariosession);
                return redirect('tipoinicio');
                
            }else{
                
                Session::put('USUARIO',$usuariosession);
                return redirect('inicio');
            }
             
        return $next($request);
    }
}

