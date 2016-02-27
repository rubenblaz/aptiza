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
    public function encuestas(Request $req)
    {
        $usuario1 = new alumno();
        $empresa1 = new empresa();


        $seleccion = $req->get('opciones');
        $idpreguntas = Session::get('preguntas');

        $usuario = Session::get('USUARIO')->getEmail();
        //$curso = Session::get('cursoalumno');
        $curso = $usuario1->obtenerCurso(Session::get('USUARIO')->getEmail());

        foreach ($idpreguntas as $idp) {
            $idpreguntas_v[] = $idp->IDPREGUNTA;
        }

        if (Session::get('USUARIO')->hasRol(6)) { //Alumnos
            DB::table('encuesta')->insert(
                ['IDUSUARIO' => $usuario, 'IDCICLO' => $curso, 'IDMODELO' => 1]
            );
            $idencuesta = $usuario1->obtenerIdEncuesta($usuario);

            for ($i = 0; $i < count($idpreguntas_v); $i++) {
                DB::table('elige')->insert(
                    ['IDENCUESTA' => $idencuesta, 'IDPREGUNTA' => $idpreguntas_v[$i], 'IDOPCION' => $seleccion[$i]]);
            }
        }
        if (Session::get('USUARIO')->hasRol(4)) { //Empresas
            DB::table('encuesta')->insert(
                ['IDUSUARIO' => $usuario, 'IDCICLO' => $curso, 'IDMODELO' => 2]
            );
            $idencuesta = $usuario1->obtenerIdEncuesta($usuario);
            for ($i = 0; $i < count($idpreguntas_v); $i++) {
                DB::table('elige')->insert(
                    ['IDENCUESTA' => $idencuesta, 'IDPREGUNTA' => $idpreguntas_v[$i], 'IDOPCION' => $seleccion[$i]]);
            }
        }
        return view('FCT/encuestas');
    }
}
