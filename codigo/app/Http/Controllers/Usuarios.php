<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Session;
use App\Http\Requests\PerfilRequest;
use Illuminate\Http\Request;
use App\Modelo\Usuario;

class Usuarios extends Controller
{

    public function errorlogin()
    {
        return view('login', ['error' => true]);
    }

    public function inicio()
    {

        return view('inicio');
    }

    public function logout()
    {

        Session::pull('USUARIO');

        return view('login');
    }

    public function tipoinicio()
    {

        return view('tipoinicio');
    }

    public function perfilUsuario()
    {

        return view('perfilUsuario');
    }

    public function editarPerfil(Request $req)
    {

        $nombre = $req->nombre;
        $email = Session::get('USUARIO')->getEmail();
        Usuario::editar_perfil($nombre, $email);
        Session::get('USUARIO')->setNombre($nombre);
        return redirect()->action('Usuarios@perfilUsuario');
    }

    public function editarPassword(PerfilRequest $req)
    {

        $email = Session::get('USUARIO')->getEmail();
        $password_anterior = $req->password_anterior;
        $nuevo_password = $req->password_nuevo;
    //   dd($email.'//'.$password_anterior.'//'.$nuevo_password.'//'.Session::get('USUARIO')->getPass());

        if ($password_anterior == Session::get('USUARIO')->getPass()) {
            //dd($email.'//'.$password_anterior.'//'.$nuevo_password.'//'.Session::get('USUARIO')->getPass());
            $usuario = new Usuario($email, $nuevo_password);
            $usuario->nuevoPass($nuevo_password);
            Session::get('USUARIO')->setPass($nuevo_password);
            return view('perfilUsuario', ['mensaje' => 'Guardado correctamente']);

        } else {
            return view('perfilUsuario', ['mensaje_error' => 'La contraseña anterior no es correcta']);
        }

    }
}
