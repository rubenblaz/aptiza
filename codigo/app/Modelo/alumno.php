<?php


namespace app\Modelo;

use App\Http\Controllers\FCT\encuestas;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\Modelo\encuesta;

class alumno
{

    /**
     * alumno constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $seleccion_alumnos
     * @param $usuario_empresa
     * @return mixed
     * Actualiza la empresa de los alumnos seleccionados a la empresa seleccionada.
     */
    public function actualizarAlumnos($seleccion_alumnos, $usuario_empresa)
    {
        for ($i = 0; $i < count($seleccion_alumnos); $i++) {
            $update = DB::table('alumno_empresa')
                ->where('IDALUMNO', $seleccion_alumnos[$i])
                ->update(['IDEMPRESA' => $usuario_empresa[0]->EMAIL]);
        }
        return $update;
    }

    /**
     * @param $curso_tutor
     * @return mixed
     * Obtiene el nombre y apellidos de los alumnos del tutor logueado en el la plataforma.
     */
    public function obtenerDatosAlumnos($curso_tutor)
    {
        /**
        $alumnos = DB::table('alumno')
            ->select('NOMBRE', 'APELLIDOS')
            ->where('CURSO', $curso_tutor[0]->NOMBRE)
            ->get();
        **/
        $alumnos = DB::table('alumno')
            ->join('matricula', 'alumno.COD', '=', 'matricula.ALUMNO')
            ->select('NOMBRE', 'APELLIDOS')
            ->where('matricula.GRUPO', $curso_tutor[0]->NOMBRE)
            ->get();

        return $alumnos;
    }

    /**
     * @param $email
     * @return mixed
     * Obtiene el curso del alumno que tenga el $email que se le pasa como parámetro.
     */
    public function obtenerCurso($email)
    {
        /**
        $consulta = DB::table('alumnos')
            ->select('CURSO')
            ->where('EMAIL', $email)
            ->get();
        **/
        /**
         * Adaptado a aptiza
         */
        $consulta = DB::table('matricula')
            ->join('alumno', 'alumno.COD', '=', 'matricula.ALUMNO')
            ->select('matricula.GRUPO')
            ->where('alumno.EMAIL', $email)
            ->get();
        return $consulta;
    }

    public function obtenerCurso2($email){
        $consulta = DB::table('alumno_empresa')
            ->select('IDCURSO')
            ->where('IDEMPRESA', $email)
            ->get();
        return $consulta;
    }

    /**
     * @param $usuario
     * @return mixed
     * Obtiene la ID de la encuesta del $usuario pasado como parámetro.
     */
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

    /**
     * @param $email
     * @return mixed
     * Obtiene el nombre del curso del alumno con el $email pasado como parámetro.
     */
    public function obtenerNombreCurso($email)
    {
        /**
        $nombrecurso = DB::table('cursos')
            ->join('alumnos', 'alumnos.CURSO', '=', 'cursos.IDCICLO')
            ->select('cursos.CICLO')
            ->where('alumnos.EMAIL', $email)
            ->get();**/
        $nombrecurso = DB::table('matricula')
            ->join('alumno', 'alumno.COD', '=', 'matricula.ALUMNO')
            ->select('matricula.GRUPO')
            ->where('alumno.EMAIL', $email)
            ->get();
        return $nombrecurso;
    }

    /**
     * @param $email
     * @return mixed
     * Obtiene las encuestas de los alumnos realizadas.
     */
    public function obtenerEncuestas($email)
    {
        $consulta1 = DB::table('profesores')
            ->select('CURSO')
            ->where('EMAIL', $email)
            ->get();
        $curso = $consulta1[0]->CURSO;
        $consulta2 = DB::table('encuesta')//ENCUESTAS
        ->join('elige', 'encuesta.IDENCUESTA', '=', 'elige.IDENCUESTA')
            ->join('profesores', 'profesores.CURSO', '=', 'encuesta.IDCICLO')
            ->select('encuesta.IDENCUESTA', 'elige.IDOPCION')
            ->where('profesores.CURSO', $curso)
            ->where('profesores.EMAIL', $email)
            ->where('encuesta.IDMODELO', 1)
            ->orderBy('encuesta.IDENCUESTA')
            ->get();

        return $consulta2;
    }
}