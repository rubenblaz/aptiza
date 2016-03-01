<?php


namespace app\Modelo;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class alumno
{

    /**
     * alumno constructor.
     */
    public function __construct()
    {

    }

    public function actualizarAlumnos($seleccion_alumnos, $usuario_empresa)
    {
        for ($i = 0; $i < count($seleccion_alumnos); $i++) {
            $update = DB::table('alumnos')
                ->where('N_EXP', $seleccion_alumnos[$i])
                ->update(['IDEMPRESA' => $usuario_empresa[0]->EMAIL, 'CALIFICACION' => 'APTO']);
        }
        return $update;
    }

    public function obtenerDatosAlumnos($curso_tutor)
    {
        $alumnos = DB::table('alumnos')
            ->select('NOMBRE', 'APELLIDOS')
            ->where('CURSO', $curso_tutor[0]->CURSO)
            ->get();

        return $alumnos;
    }

    public function obtenerCurso($email)
    {
        $consulta = DB::table('alumnos')
            ->select('CURSO')
            ->where('EMAIL', $email)
            ->get();

        return $consulta;
    }

    public function obtenerIdEncuesta($usuario)
    {
        $consulta = DB::table('encuesta')
            ->select('IDENCUESTA')
            ->where('IDUSUARIO', $usuario)
            ->max('IDENCUESTA');

        return $consulta;
    }

    public function insertarEncuesta()
    {

    }

    public function obtenerNombreCurso($email)
    {
        $nombrecurso = DB::table('cursos')
            ->join('alumnos', 'alumnos.CURSO', '=', 'cursos.IDCICLO')
            ->select('cursos.CICLO')
            ->where('alumnos.EMAIL', $email)
            ->get();
        return $nombrecurso;
    }

    public function obtenerEncuestas($email)
    {
        $consulta1 = DB::table('profesores')
            ->select('CURSO')
            ->where('EMAIL', $email)
            ->get();
        $curso = $consulta1[0]->CURSO;
        $consulta2 = DB::table('encuesta')
            ->join('elige', 'encuesta.IDENCUESTA', '=', 'elige.IDENCUESTA')
            ->join('profesores', 'profesores.CURSO', '=', 'encuesta.IDCICLO')
            ->select('encuesta.IDENCUESTA', 'encuesta.IDUSUARIO', 'elige.IDPREGUNTA', 'elige.IDOPCION')
            ->where('profesores.CURSO', $curso)
            ->where('profesores.EMAIL', $email)
            ->get();

        return $consulta2;
    }
}