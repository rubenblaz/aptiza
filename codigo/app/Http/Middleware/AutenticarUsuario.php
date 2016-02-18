<?php namespace App\Http\Middleware;

use Closure;
use App\Modelo\Usuario;
use Session;
use Carbon\Carbon;

class AutenticarUsuario {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
//        setlocale(LC_TIME, 'Spanish');
//        dd(Carbon::now()->formatLocalized('%A %d %B %Y'));
        $loale = new Locale();
       // $locale = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
dd($locale);

        if ($request->input('email') != null) {

            $usuario = new Usuario($request->input('email'), $request->input('pass'));
            if (($usuariosession = $usuario->esValido())) {
                Session::put('USUARIO', $usuariosession);
            } else {
                return redirect()->route('errorlogin');
            }
        }
        return $next($request);
    }
}
