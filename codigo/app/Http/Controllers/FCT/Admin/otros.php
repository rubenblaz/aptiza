<?php

namespace App\Http\Controllers\FCT\Admin;

use App\Modelo\alumno;
use App\Modelo\encuesta;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\Modelo\empresa;

class otros extends Controller
{
    public function admincuenta()
    {
        return view('FCT/admincuenta');
    }

    public function admincuenta2(Request $req)
    {
        $contraseña_actual = $req->get('passactual');
        $contraseña_nueva = $req->get('passnueva');
        $contraseña_nueva2 = $req->get('passnueva2');
        $mensaje = "";

        $consulta = DB::table('usuarios')
            ->select('*')
            ->where('PASSWORD', $contraseña_actual)
            ->where('EMAIL', Session::get('USUARIO')->getEmail())
            ->count();

        $existe = false;

        if ($consulta > 0) {
            $exite = true;
            if ($contraseña_nueva == $contraseña_nueva2) {
                DB::table('usuarios')
                    ->where('PASSWORD', $contraseña_actual)
                    ->where('EMAIL', Session::get('usuario'))
                    ->update(['PASSWORD' => $contraseña_nueva2]);
                $mensaje = "Correcto";
            }
        } else {
            $mensaje = "Error";
        }

        $datos = [
            'mensaje' => $mensaje
        ];

        return view('FCT/admincuenta', $datos);
    }

    public function urlempresas()
    {
        return view('FCT/Admin/altaempresas');
    }

    public function urlinforme()
    {
        return view('FCT/invoice');
    }

    public function urlencuestasemp()
    {
        $empresa1 = new empresa();

        return view('encuestasemp');
    }

    public function urlmodempresas()
    {
        //Mostrar las empresas con boton de editar al lado, pasar por get el CIF
        return view('FCT/Admin/modempresas');
    }

    public function modempresas(){
        //Aqui hacer el update
    }
}
