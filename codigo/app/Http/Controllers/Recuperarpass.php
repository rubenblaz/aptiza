<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecuPassRequest;
use App\Http\Requests\RecuEmailRequest;
use App\Modelo\Usuario;
use DB;
use Mail;
use Session;

class Recuperarpass extends Controller {
    public function introducirEmail(){
        return view('solicitarecupass');
    }
    public function mandarPassEmail(RecuEmailRequest $request) {
        $datos = array();

        $email = $request->input('email');

        if (Usuario::existeUsuario($email)) {
            $datosemail['email'] = $email;
            $datosemail['pass'] = DB::table('usuarios')->select('pass')->where('EMAIL', $email)->get()[0]->pass;

            Mail::send('emails.recuperarpass', $datosemail, function($message)use ($email) {
                $message->to($email)->subject('Cambio de contraseña');
            });
            $datos = ['mensaje' => 'Revise su correo y siga las instrucciones para reestablecer su contraseña'];
        } else {
            if ($email != null) {
                $datos['error'] = 'No existe usuario';
            }
            return view('solicitarecupass', $datos);
        }
        return view('login', $datos);
    }

    public function nuevoPassEmail(Request $request) {

        if (!Session::has('USUARIO')) {

            $email = $request->input('email');
            $pass = $request->input('pass');

            $usuario = (new Usuario($email, $pass))->esValido(); //devuelve un usuario con todos los datos incluidos roles.
            
            if($usuario != null && $usuario->tieneDobleRol()){
                $usuario->usarComoAdmin(true);
            }

            if($usuario == null){
                return view('login');
            }else{
                Session::put('INVITADO', $usuario);
                return view('reestablecepass', ['email' => $email, 'pass' => $pass]);
            }
            
        } else {
            return view('inicio');
        }
    }

    public function estableceNuevoPass(RecuPassRequest $request) {
        Session::put('USUARIO',Session::pull('INVITADO'));
        Session::get('USUARIO')->nuevoPass($request->input('pass'));
        return redirect()->route('inicio');
    }
    
}
