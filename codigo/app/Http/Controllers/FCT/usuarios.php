<?php

namespace App\Http\Controllers\FCT;

use App\Modelo\alumno;
use Illuminate\Http\Request;
use App\Modelo\empresa;
use App\Modelo\profesor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class usuarios extends Controller
{
    public function alta(Request $req)
    {
        Session::pull('mensajealta');
        /*
         * Datos de alta de las empresas
         */
        $usuario_empresa = $req->get('usuario');
        $mensaje_v = array();
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
        $password = $req->get('password');
        $email = $req->get('email');
        $fechaconv_vec = date("Y-m-d", strtotime($fechaconv)); //Conversion de formato
        $fav = $req->get('favorita');
        $empresa1 = new empresa();

        $existe = $empresa1->comprobarEmpresa($cif);
        $existe2 = $empresa1->comprobarUsuario($usuario_empresa);

        /*
         * Insertar los datos del formulario en la tabla de empresas
         */
        $rol = 4;
        if ($existe == false && $existe2 == false) {
            $empresa1->insertarUsuario($usuario_empresa, $password, $nombre);
            $empresa1->insertarEmpresa($usuario_empresa, $cif, $nombre, $cp, $telefono, $dnirep, $convenio, $alias, $poblacion, $fax, $observaciones, $fechaconv_vec, $direccion, $provincia, $convrep, $tipoempresa, $fav);
            $mensaje = "ok";
            Session::put('mensajealta', $mensaje);
        } else {
            $mensaje = "error";
            Session::put('mensajealta', $mensaje);
        }
        return redirect('altaempresas');
    }

    public function practicas(Request $req)
    {
        $profesor1 = new profesor();
        $empresa1 = new empresa();

        $curso_tutor = $profesor1->cursoTutor(Session::get('USUARIO')->getEmail());

        $alumnos = $profesor1->misAlumnos($curso_tutor);

        //Cuenta cuantos alumnos hay
        $cantidad_alumnos = count($alumnos);
        $cont = 0;
        $vec_aux = array();
        while ($cont < $cantidad_alumnos) {
            $vec_aux[$cont] = DB::table('cursos')->select('CICLO')->where('IDCICLO', $alumnos[$cont]->CURSO)->get();
            $cont++;
        }

        $empresas_fav = $empresa1->empresasFavoritas();

        $empresas_fav_vec = array();

        foreach ($empresas_fav as $emp) {
            $empresas_fav_vec[$emp->CIF] = $emp->NOMBRE;
        }

        $datos = [
            'empresas' => $empresas_fav_vec,
            'alumnos' => $alumnos,
            'cursos' => $vec_aux
        ];
        return view('FCT/practicas', $datos);
    }

    public function practicas_elegir(Request $req)
    {
        $empresa1 = new empresa();
        $alumno1 = new alumno();

        $seleccion_alumnos = $req->get('seleccionado'); //N_EXP de los alumnos que elige
        $seleccion_empresa = $req->get('empresas'); //Empresa que elige en el select list

        $mensaje = " ";
        $mensajes = array();

        $usuario_empresa = $empresa1->usuarioEmpresa($seleccion_empresa);

        $update = $alumno1->actualizarAlumnos($seleccion_alumnos, $usuario_empresa);

        for ($i = 0; $i < count($seleccion_alumnos); $i++) {
            if ($update) {
                $mensajes[$i] = "ok";
            } else {
                $mensajes[$i] = "Error con el alumno: " . $seleccion_alumnos[$i];
            }
        }

        for ($i = 0; $i < count($mensajes); $i++) {
            if (equalToIgnoringWhiteSpace(equalToIgnoringCase($mensajes[$i], "Error"))) {
                $mensaje = $mensajes[$i];
                Session::put('operacion', $mensaje);
            } else {
                $mensaje = "ok";
                Session::put('operacion', $mensaje);
            }
        }

        return redirect('practicas');
    }

    public function consulta(Request $req)
    {
        Session::pull('deleteinfo');
        Session::pull('empresafav');
        $empresa1 = new empresa();

        $todas_empresas = $empresa1->todasEmpresas();

        $datos = [
            'empresas' => $todas_empresas
        ];
        return view('FCT/consulta', $datos);
    }

    public function empresas_favoritas(Request $req)
    {

        $empresasfav = $req->get('favoritas');

        for ($i = 0; $i < count($empresasfav); $i++) {
            $update = DB::table('empresas')
                ->where('CIF', $empresasfav[$i])
                ->update(['FAVORITA' => 'SI']);
        }
        if ($update) {
            $mensaje = "ok";
            Session::put('empresafav', $mensaje);
        } else {
            $mensaje = "error";
            Session::put('empresafav', $mensaje);
        }
        return redirect('consulta');
    }

    public function borrar_empresa(Request $req)
    {
        $empresa1 = new empresa();
        $cif = $req->CIF;

        $update = $empresa1->borrarFavorita($cif);
        if (!$update) {
            $mensaje = "ok";
            Session::put('deleteinfo', $mensaje);
        } else {
            $mensaje = "error";
            Session::put('deleteinfo', $mensaje);
        }
        return redirect('consulta');
    }

    public function memoriafinal()
    {
        return view('FCT/memoriafinal');
    }

    public function resumenalumnos()
    {
        $alumno1 = new alumno();
        $encuestas = $alumno1->obtenerEncuestas(Session::get('USUARIO')->getEmail());
        dd($encuestas);

        return view('FCT/resumenalumnos', $encuestas);
    }

    public function resumenempresas()
    {

    }
}
