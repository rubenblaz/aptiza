<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\PasswordRequest;
use App\Modelo\Usuario;
use Session;
use Mail;


class UsuarioController extends Controller
{

    public function index(Request $req)
    {
        $res = Usuario::listar_roles();
        $mensaje = $req->input('mensaje');
        $mensaje_error = $req->input('mensaje_error');
        foreach ($res as $rol) {
            $roles[$rol->ID] = $rol->TIPO;
        }
        if ($mensaje_error) {
            return view('admin/usuarios/formUsuario', ['mensaje_error' => $mensaje_error, 'roles' => $roles]);
        } else {
            if ($mensaje) {
                return view('admin/usuarios/formUsuario', ['mensaje' => $mensaje, 'roles' => $roles]);
            } else {
                return view('admin/usuarios/formUsuario', ['roles' => $roles]);
            }
        }

    }

    public function crear(UserRequest $req)
    {
        $roles = $req->roles_selec;
        $nombre = $req->nombre;
        $email = $req->email;
        $password = $req->password;
        $existe_usuario=Usuario::existeUsuario($email);
        if(!$existe_usuario) {

            $res = Usuario::crear_usuario($nombre, $email, $password, $roles);
            $mensaje = 'Creado correctamente';
            $datosemail['email'] = $email;
            $datosemail['pass'] = Usuario::seleccionar_usuario($email)[0]->PASS;

            Mail::send('emails.recuperarpass', $datosemail, function($message)use ($email) {
                $message->to($email)->subject('Cambio de contraseña');
            });
            return redirect()->action('admin\UsuarioController@listar', ['mensaje' => $mensaje]);
        }
        else {
            $mensaje_error = 'Correo duplicado';
            return redirect()->action('admin\UsuarioController@index', ['mensaje_error' => $mensaje_error]);
        }


    }

    public function eliminar(Request $req)
    {
        $email = $req->EMAIL;
        $res_del = Usuario::eliminar_usuario($email);
        $mensaje = 'Eliminado correctamente';

        return redirect()->action('admin\UsuarioController@listar', ['mensaje' => $mensaje]);
    }

    public function editar(Request $req)
    {
        $email = $req->EMAIL;
        $res_roles = Usuario::listar_roles();
        foreach ($res_roles as $rol) {
            $roles[$rol->ID] = $rol->TIPO;
        }
        $res = Usuario::seleccionar_usuario($email);
        $roles_usuario=Usuario::rolesUsuario($email);
        $mensaje_error = $req->input('mensaje_error');

        if ($mensaje_error) {
            $datos = ['usuarios_vec' => $res, 'roles' => $roles,'roles_usuario'=>$roles_usuario,'mensaje_error'=>$mensaje_error];
            return view('admin/usuarios/editUsuario', $datos);
        } else {
            $datos = ['usuarios_vec' => $res, 'roles' => $roles,'roles_usuario'=>$roles_usuario];
            return view('admin/usuarios/editUsuario', $datos);
        }

    }

    public function listar(Request $req)
    {
        $mensaje = $req->input('mensaje');
        $mensaje_error = $req->input('mensaje_error');
        $res = Usuario::listar_usuarios();

        if ($mensaje_error) {
            $datos = array('lista_usuarios' => $res, 'mensaje_error' => $mensaje_error);
            return view('admin/usuarios/listarUsuario', $datos);
        } else {
            if ($mensaje) {
                $datos = array('lista_usuarios' => $res, 'mensaje' => $mensaje);
                return view('admin/usuarios/listarUsuario', $datos);
            } else {
                $datos = array('lista_usuarios' => $res);
                return view('admin/usuarios/listarUsuario', $datos);
            }
        }


    }

    public function actualizar(UserEditRequest $req)
    {
        $roles = $req->roles_selec;
        $nombre = $req->nombre;
        $email_anterior = $req->email_anterior;
        $email = $req->email;
        $existe_usuario=Usuario::existeUsuario($email);
        if($email==$email_anterior) {
            $res = Usuario::editar_usuario($nombre, $email_anterior, $email, $roles);
            $mensaje = 'Actualizado correctamente';
            return redirect()->action('admin\UsuarioController@listar', ['mensaje' => $mensaje]);
        }
        if(!$existe_usuario) {
            $res = Usuario::editar_usuario($nombre, $email_anterior, $email, $roles);
            $mensaje = 'Actualizado correctamente';
            return redirect()->action('admin\UsuarioController@listar', ['mensaje' => $mensaje]);
        }
        else {
            $mensaje_error = 'Correo duplicado';
            return redirect()->action('admin\UsuarioController@editar', ['mensaje_error' => $mensaje_error,
            'EMAIL'=>$email_anterior]);
        }

    }
    public function formPassword(Request $req)
    {
        $email=$req->EMAIL;

        return view('admin/usuarios/formPassword',array('email'=>$email));
    }
    public function cambiarPassword(PasswordRequest $req)
    {
        $password=$req->password;
        $email=$req->email;
        $usuario=new Usuario($email,$password);
        $usuario->nuevoPass($password);
        $mensaje = 'Actualizado correctamente';
        return redirect()->action('admin\UsuarioController@listar', ['mensaje' => $mensaje]);
    }



}