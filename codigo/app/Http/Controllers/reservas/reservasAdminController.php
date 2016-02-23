<?php

namespace App\Http\Controllers\reservas;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Modelo\Aula;
use App\Modelo\Hora;

class reservasAdminController extends Controller
{

    public function mostrar_aulas(Request $req)
    {
        $res_aul = Aula::mostrar_aulas();
        $mensaje=$req->input('mensaje');
        $mensaje_error=$req->input('mensaje_error');
        if($mensaje_error) {
            $datos = array('aulas' => $res_aul, 'mensaje_error' => $mensaje_error);
        }
        else {
            if ($mensaje) {
                $datos = array('aulas' => $res_aul, 'mensaje' => $mensaje);
            } else {
                $datos = array('aulas' => $res_aul);
            }
        }

        return view('admin/aulas/administrar_aula', $datos);
    }

    public function crear_aulas(Request $req)
    {

        $nombre = $req->nombre_aula;
        $res = Aula::crear_aula($nombre);
        $mensaje = 'Creado correctamente';
        return redirect()->action('reservas\reservasAdminController@mostrar_aulas', ['mensaje'=>$mensaje]);

    }

    public function eliminar_aula(Request $req)
    {
        $nombre = $req->AULA;
        $res_del = Aula::eliminar_aula($nombre);
        $mensaje = 'Eliminado correctamente';
        return redirect()->action('reservas\reservasAdminController@mostrar_aulas',['mensaje'=>$mensaje]);


    }

    public function editar_aula(Request $req)
    {
        $nuevo_nombre = $req->nombre_aula;
        $anterior_nombre = $req->aula_editada;
        $res_update = Aula::editar_aula($anterior_nombre, $nuevo_nombre);
        $mensaje = 'Editado correctamente';
        return redirect()->action('reservas\reservasAdminController@mostrar_aulas', ['mensaje'=>$mensaje]);

    }
    public function mostrar_horas(Request $req)
    {
        $res_horas = Hora::mostrar_horas();
        $mensaje=$req->input('mensaje');
        $mensaje_error=$req->input('mensaje_error');
        if($mensaje_error) {
            $datos = array('horas_vec' => $res_horas, 'mensaje_error' => $mensaje_error);
        }
        else {
            if ($mensaje) {
                $datos = array('horas_vec' => $res_horas, 'mensaje' => $mensaje);
            } else {
                $datos = array('horas_vec' => $res_horas);
            }
        }

        return view('admin/horas/administrar_horas', $datos);

    }

    public function crear_horas(Request $req)
    {
        $mensaje = 'Creado correctamente';
        $hora = $req->timepicker;
        $res = Hora::crear_hora($hora);
        return redirect()->action('reservas\reservasAdminController@mostrar_horas', ['mensaje'=>$mensaje]);

    }


    public function eliminar_horas(Request $req)
    {
        $num_hora = $req->NUMHORA;
        $res_del = Hora::eliminar_hora($num_hora);
        $mensaje = 'Eliminado correctamente';
        return redirect()->action('reservas\reservasAdminController@mostrar_horas',['mensaje'=>$mensaje]);
    }

    public function editar_hora(Request $req)
    {
        $id_hora = $req->hora_editada;
        $nueva_hora = $req->time_hora;
        $res_update = Hora::editar_hora($id_hora, $nueva_hora);
        $mensaje = 'Editado correctamente';
        return redirect()->action('reservas\reservasAdminController@mostrar_horas',['mensaje'=>$mensaje]);
    }

}