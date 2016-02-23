<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Modelo\Aula;
use App\Modelo\Hora;
use App\Http\Requests\UserRequest;
use App\Modelo\Usuario;
use Session;


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
        $rol = $req->rol;
        $nombre = $req->nombre;
        $email = $req->email;
        $password = $req->password;
        $password_encript = \Hash::make($password);
        $res = Usuario::crear_usuario($nombre, $email, $password_encript, $rol);
        $mensaje = 'Creado correctamente';
        return redirect()->action('admin\UsuarioController@listar', ['mensaje' => $mensaje]);


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
        $datos = ['usuarios_vec' => $res, 'roles' => $roles];
        return view('admin/usuarios/editUsuario', $datos);

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

    public function actualizar(UserRequest $req)
    {
        $rol = $req->rol;
        $nombre = $req->nombre;
        $email_anterior = $req->email_anterior;
        $email = $req->email;
        $password = $req->password;
        $password_encript = \Hash::make($password);
        $res = Usuario::editar_usuario($nombre, $email_anterior, $email, $password_encript, $rol);
        $mensaje = 'Actualizado correctamente';
        return redirect()->action('admin\UsuarioController@listar', ['mensaje' => $mensaje]);

    }


}