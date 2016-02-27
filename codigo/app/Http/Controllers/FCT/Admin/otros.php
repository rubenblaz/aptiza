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

    public function urlencuestas() //pendiente de modificar
    {
        $usuario1 = new alumno();
        $empresa1 = new empresa();
        $encuesta1 = new encuesta();
        $usuario = Session::get('USUARIO')->getEmail();
        $curso = Session::get('cursoalumno');

        if (Session::has('USUARIO')) {
            if (Session::get('USUARIO')->hasRol(4)) {
                $preguntas = $encuesta1->obtenerPreguntasEmpresas();
                $curso_empresa = $empresa1->obtenerCursoAlumnos($usuario);
                $mi_nombre = $empresa1->obtenerNombre($usuario);
                Session::put('mi_nombre', $mi_nombre[0]->NOMBRE);
                Session::put('curso_empresa', $curso_empresa[0]->CICLO);
            }
            if (Session::get('USUARIO')->hasRol(6)) {
                $curso_alumno = $usuario1->obtenerCurso(Session::get('usuario'));
                Session::put('cursoalumno', $curso_alumno[0]->CURSO);
                $nombre_curso = $usuario1->obtenerNombreCurso($usuario);
                $nombre_empresa = $empresa1->obtenerNombreEmpresa($usuario);
                Session::put('nombre_curso', $nombre_curso[0]->CICLO);
                Session::put('nombre_empresa', $nombre_empresa[0]->NOMBRE);
                $preguntas = $encuesta1->obtenerPreguntasAlumnos();
            }
        }

        Session::put('preguntas', $preguntas);

        //dd($preguntas);

        $opciones = DB::table('modelo_opcion')
            ->select('IDOPCION', 'OPCION')
            ->get();
        $opciones_v = array();

        foreach ($opciones as $opc) {
            $opciones_v[$opc->IDOPCION] = $opc->OPCION;
        }

        $datos = [
            'preguntas' => $preguntas,
            'opciones' => $opciones_v
        ];

        return view("FCT/encuestas", $datos);
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
