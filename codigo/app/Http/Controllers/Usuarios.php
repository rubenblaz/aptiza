<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo\Usuario;
use DB;
use Hash;
use Mail;
use Session;
use Validator;

class Usuarios extends Controller
{    
    public function errorlogin(){
        
        return view('login',['error'=> true]);
    }
    
    public function inicio(){
        return view('inicio');
    }
    
    public function logout(){
      
           Session::pull('USUARIO');
       
       return view('login');
    }
    
    public function recuperapass(Request $request){
        $datos = array();
        
        $email = $request->input('email');
        
        if(Usuario::existeUsuario($email)){
            $datosemail['email'] = $email;
            $datosemail['pass'] = DB::table('usuarios')->select('pass')->where('EMAIL',$email)->get()[0]->pass;
            
            Mail::send('emails.recuperarpass', $datosemail, function($message)use ($email){
            $message->to($email)->subject('Cambio de contraseña');
            });
        }else{
           $datos['error'] = 'No existe usuario';
           return view('recuperapass', $datos); //mandar a recuperarpass con error.
        }
        return view('login', ['mensaje' => 'Revise su correo y siga las instrucciones para reestablecer su contraseña']); //mandar a login con mensaje.
    }
    
    public function reestablecepass(Request $request){
        
        $email = $request->input('email');
        $pass = $request->input('pass');
        
        $usuario = new Usuario($email,$pass);
        
        if(($usuariosession = $usuario->esValido())){
            Session::put('USUARIO',$usuariosession);
            return view('reestablecepass',['email' => $email, 'pass' => $pass]);
        }else{
            return view ('login');
        }
    }
    
    public function cambiarpass(Request $request){
        
        Session::get('USUARIO')->nuevoPass($request->input('pass'));
        return view('inicio');
    }
}
//CHULETA
//        $fecha = date_create('12-03-2013');
//        $fecha = date_format($fecha, 'd/m/Y');