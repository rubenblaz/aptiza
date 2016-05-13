<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 12/02/16
 * Time: 10:16
 */

namespace app\Modelo;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class profesor
{

    /**
     * profesor constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $usuario
     * @return mixed
     * Obtiene el curso del tutor pasado como parámetro.
     */
    public function cursoTutor($usuario)
    {
        $curso_tutor = DB::table('grupo')
            ->join('profesor', 'profesor.COD', '=', 'grupo.TUTOR')
            ->select('grupo.NOMBRE', 'grupo.CURSO')
            ->where('profesor.EMAIL', $usuario)
            ->get();

        return $curso_tutor;
    }

    /**
     * @param $curso_tutor
     * @return mixed
     * Devuelve una lista con los alumnos del curso del tutor.
     */
    public function misAlumnos($curso_tutor)
    {

        /**$alumnos = DB::table('empresas')
         * ->join('alumnos', 'alumnos.IDEMPRESA', '=', 'empresas.EMAIL')
         * ->select('alumnos.N_EXP','alumnos.CURSO','alumnos.NOMBRE', 'alumnos.APELLIDOS', 'empresas.NOMBRE as NOMBRE_E')
         * ->where('alumnos.CURSO', $curso_tutor[0]->CURSO)
         * ->paginate(10);
         **/
        /*$alumnos = DB::table('alumnos')
            ->select('N_EXP', 'NOMBRE', 'APELLIDOS', 'CURSO', 'CALIFICACION')
            ->where('CURSO', $curso_tutor[0]->CURSO)
            ->paginate(10);*/

        $alumnos = DB::table('alumno')
            ->join('matricula', 'matricula.ALUMNO', '=', 'alumno.COD')
            ->join('alumno_empresa', 'alumno_empresa.IDALUMNO', '=', 'alumno.COD')
            ->join('empresas', 'empresas.EMAIL', '=', 'alumno_empresa.IDEMPRESA')
            ->select('alumno.NOMBRE', 'alumno.APELLIDOS', 'alumno_empresa.IDEMPRESA', 'alumno.COD', 'empresas.NOMBRE AS NOMBRE_E')
            ->where('matricula.GRUPO', $curso_tutor[0]->NOMBRE)
            ->paginate(10);
        return $alumnos;
    }

    /**
     * @param $email
     * @return mixed
     * Devuelve el nombre y apellidos del profesor pasado como parametro.
     */
    public function obtenerNombreApellidos($email)
    {
        $consulta = DB::table('profesor')
            ->select('NOMBRE', 'APELLIDOS')
            ->where('EMAIL', $email)
            ->get();
        return $consulta;
    }

    /**
     * @param $email
     * @return mixed
     * Devuelve el nombre del curso del profesor pasado como parametro.
     */
    public function nombreCurso($email)
    {
        /**
         * $consulta = DB::table('cursos')
         * ->join('profesores', 'profesores.CURSO', '=', 'cursos.IDCICLO')
         * ->select('cursos.CICLO')
         * ->where('profesores.EMAIL', $email)
         * ->get();
         **/
        $consulta = DB::table('grupo')
            ->join('profesor', 'profesor.COD', '=', 'grupo.TUTOR')
            ->select('grupo.NOMBRE')
            ->where('profesor.EMAIL', $email)
            ->get();
        return $consulta;
    }

    /**
     * @param $curso
     * @return mixed
     * Devuelve una lista con los alumnos del curso pasado como parametro.
     */
    public function misAlumnos2($curso)
    {
        /**
         * $consulta = DB::table('alumnos')
         * ->join('empresas', 'empresas.EMAIL', '=', 'alumnos.IDEMPRESA')
         * ->select('alumnos.NOMBRE', 'alumnos.APELLIDOS', 'alumnos.EMAIL', 'alumnos.TELEFONO_M', 'alumnos.TELEFONO_F', 'empresas.NOMBRE AS NOMBRE_E', 'empresas.CONVENIO')
         * ->where('alumnos.CURSO', $curso)
         * ->get();
         **/
        /**
         * $consulta = DB::table('alumno')
         * ->join('matricula', 'matricula.GRUPO', '=', 'alumno.COD')
         * ->join('alumno_empresa', 'alumno_empresa.IDALUMNO', '=', 'alumno.COD')
         * ->join('empresas', 'empresas.EMAIL', '=', 'alumno_empresa.IDEMPRESA')
         * ->select('alumno.NOMBRE', 'alumno.APELLIDOS', 'alumno.EMAIL', 'alumno_empresa.IDEMPRESA AS EMPRESA_EMAIL', 'empresas.CONVENIO' )
         * ->where('matricula.GRUPO', $curso)
         * ->get();
         * **/
        $consulta = DB::table('alumno')
            ->join('matricula', 'alumno.COD', '=', 'matricula.ALUMNO')
            ->join('alumno_empresa', 'alumno_empresa.IDALUMNO', '=', 'alumno.COD')
            ->join('empresas', 'empresas.EMAIL', '=', 'alumno_empresa.IDEMPRESA')
            ->select('alumno.NOMBRE', 'alumno.APELLIDOS', 'alumno.EMAIL', 'alumno.TELEFONO_F', 'alumno.TELEFONO_M', 'empresas.NOMBRE AS NOMBRE_E', 'empresas.CONVENIO')
            ->where('matricula.GRUPO', $curso)
            ->get();
        return $consulta;
    }

    /**
     * Obtiene los alumnos del tutor logueado
     * @param $curso
     * @return mixed
     */
    public function misAlumnos3($curso)
    {
        $consulta = DB::table('matricula')
            ->join('alumno', 'alumno.COD', '=', 'matricula.ALUMNO')
            ->select('alumno.NOMBRE', 'alumno.APELLIDOS', 'alumno.COD')
            ->where('matricula.GRUPO', $curso)
            ->paginate(10);

        return $consulta;

    }

    /**
     * Devuelve los alumnos que coinciden con la selección de aptos para las FCT
     * @param $seleccion
     * @return array
     */
    public function comprobarAlumnosSeleccion($seleccion)
    {
        $curso = $this->cursoTutor(Session::get('USUARIO')->getEmail())[0]->NOMBRE;
        $alumnos_encontrados = array();
        for ($i = 0; $i < count($seleccion); $i++) {
            $alumnos_encontrados = DB::table('alumno_empresa')
                ->select('IDALUMNO')
                ->where('IDALUMNO', $seleccion[$i])
                ->get();
        }
        return $alumnos_encontrados;
    }

    /**
     * Inserta los alumnos en la tabla que une empresas con alumnos.
     * @param $seleccion
     */
    public function admitirAlumnos($seleccion)
    {
        $curso = $this->cursoTutor(Session::get('USUARIO')->getEmail())[0]->NOMBRE;
        $empresa = DB::table('empresas')
            ->select('EMAIL')
            ->first();
        for ($i = 0; $i < count($seleccion); $i++) {
            DB::table('alumno_empresa')->insert(
                ['IDALUMNO' => $seleccion[$i], 'IDEMPRESA' => $empresa->EMAIL, 'IDCURSO' => $curso]
            );
        }
    }


}