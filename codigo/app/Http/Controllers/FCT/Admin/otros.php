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
        $empresa1 = new empresa();
        $todas_empresas = $empresa1->todasEmpresas();

        $datos = [
            'todas_empresas' => $todas_empresas
        ];

        return view('FCT/Admin/modempresas', $datos);
    }

    public function modempresas(Request $req)
    {
        $cif = $req->CIF;
        $empresa1 = new empresa();
        $empresa_modificar = $empresa1->obtenerTodosDatos($cif);

        $datos = [
            'empresa_modificar' => $empresa_modificar
        ];


        return view('FCT/Admin/modempresas_form', $datos);
    }

    public function modempresas_submit(Request $req)
    {
        $usuario_empresa = $req->get('usuario');
        $cif = $req->get('cif');
        $nombre = $req->get('nombre');
        $cp = $req->get('cp');
        $telefono = $req->get('telefono');
        $dnirep = $req->get('dnirep');
        $convenio = $req->get('convenio');
        $alias = $req->get('alias');
        $poblacion = $req->get('poblacion');
        $fax = $req->get('fax');
        $observaciones = $req->get('observaciones');
        $fechaconv = $req->get('fechaconvenio');
        $direccion = $req->get('direccion');
        $provincia = $req->get('provincia');
        $convrep = $req->get('convrep');
        $tipoempresa = $req->get('tipoempresa');
        //$password = $req->get('password');
        $email = $req->get('email');
        $fechaconv_vec = date("Y-m-d", strtotime($fechaconv)); //Conversion de formato
        $fav = $req->get('favorita');

        $empresa1 = new empresa();

        $usuario_empresa_original = $req->get('usuario_original');

        $empresa1->actualizarUsuario($usuario_empresa, $usuario_empresa_original);
        $empresa1->actualizarDatos($usuario_empresa, $cif, $nombre, $cp, $telefono, $dnirep, $convenio, $alias, $poblacion, $fax, $observaciones, $fechaconv_vec, $direccion, $provincia, $convrep, $tipoempresa, $fav, $usuario_empresa_original);


        return redirect('modempresas');
    }
}
