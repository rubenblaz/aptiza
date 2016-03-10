<?php

namespace App\Http\Controllers\FCT;

use App\Modelo\empresa;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\Modelo\metodos;
use App\Modelo\alumno;
use App\Modelo\encuesta;

class encuestas extends Controller
{
    public function urlencuestas() //pendiente de modificar
    {

        if (Session::has('preguntas')) {
            Session::forget('preguntas');
        }
        $usuario1 = new alumno();
        $empresa1 = new empresa();
        $encuesta1 = new encuesta();
        $usuario = Session::get('USUARIO')->getEmail();

        if (Session::has('USUARIO')) {
            if (Session::get('USUARIO')->hasRol(4)) {
                $preguntas = $encuesta1->obtenerPreguntasEmpresas();
                $curso_empresa = $empresa1->obtenerCursoAlumnos($usuario);
                $mi_nombre = $empresa1->obtenerNombre($usuario);
                Session::put('mi_nombre', $mi_nombre[0]->NOMBRE);
                Session::put('curso_empresa', $curso_empresa[0]->CICLO);
            }
            if (Session::get('USUARIO')->hasRol(6)) {
                $curso_alumno = $usuario1->obtenerCurso($usuario);
                Session::put('cursoalumno', $curso_alumno[0]->CURSO);
                $nombre_curso = $usuario1->obtenerNombreCurso($usuario);
                $nombre_empresa = $empresa1->obtenerNombreEmpresa($usuario);
                Session::put('nombre_curso', $nombre_curso[0]->CICLO);
                Session::put('nombre_empresa', $nombre_empresa[0]->NOMBRE);
                $preguntas = $encuesta1->obtenerPreguntasAlumnos();
            }
        }

        Session::put('preguntas', $preguntas);

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

    public function encuestas(Request $req)
    {
        $usuario1 = new alumno();



        $seleccion = $req->get('opciones');
        $idpreguntas = Session::get('preguntas');

        $usuario = Session::get('USUARIO')->getEmail();

        $curso = $usuario1->obtenerCurso(Session::get('USUARIO')->getEmail());

        foreach ($idpreguntas as $idp) {
            $idpreguntas_v[] = $idp->IDPREGUNTA;
        }
        
        if (Session::get('USUARIO')->hasRol(6)) { //Alumnos
            DB::table('encuesta')->insert(
                ['IDUSUARIO' => $usuario, 'IDCICLO' => $curso[0]->CURSO, 'IDMODELO' => 1]
            );

            $idencuesta = $usuario1->obtenerIdEncuesta($usuario);

            for ($i = 0; $i < count($idpreguntas_v); $i++) {
                DB::table('elige')->insert(
                    ['IDENCUESTA' => $idencuesta, 'IDPREGUNTA' => $idpreguntas_v[$i], 'IDOPCION' => $seleccion[$i]]);
            }
        }
        if (Session::get('USUARIO')->hasRol(4)) { //Empresas
            DB::table('encuesta')->insert(
                ['IDUSUARIO' => $usuario, 'IDCICLO' => $curso[0]->CURSO, 'IDMODELO' => 2]
            );

            $idencuesta = $usuario1->obtenerIdEncuesta($usuario);

            for ($i = 0; $i < count($idpreguntas_v); $i++) {
                DB::table('elige')->insert(
                    ['IDENCUESTA' => $idencuesta, 'IDPREGUNTA' => $idpreguntas_v[$i], 'IDOPCION' => $seleccion[$i]]);
            }
        }
        if (Session::has('preguntas')) {
            Session::forget('preguntas');
        }
        return view('inicio');
    }
}
