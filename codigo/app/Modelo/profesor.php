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
        $curso_tutor = DB::table('profesores')
            ->select('CURSO')
            ->where('EMAIL', $usuario)
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
        $alumnos = DB::table('empresas')
            ->join('alumnos', 'alumnos.IDEMPRESA', '=', 'empresas.EMAIL')
            ->select('alumnos.N_EXP','alumnos.CURSO','alumnos.NOMBRE', 'alumnos.APELLIDOS', 'empresas.NOMBRE as NOMBRE_E')
            ->where('alumnos.CURSO', $curso_tutor[0]->CURSO)
            ->paginate(10);
        /*$alumnos = DB::table('alumnos')
            ->select('N_EXP', 'NOMBRE', 'APELLIDOS', 'CURSO', 'CALIFICACION')
            ->where('CURSO', $curso_tutor[0]->CURSO)
            ->paginate(10);*/
        return $alumnos;
    }

    /**
     * @param $email
     * @return mixed
     * Devuelve el nombre y apellidos del profesor pasado como parametro.
     */
    public function obtenerNombreApellidos($email)
    {
        $consulta = DB::table('profesores')
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
        $consulta = DB::table('cursos')
            ->join('profesores', 'profesores.CURSO', '=', 'cursos.IDCICLO')
            ->select('cursos.CICLO')
            ->where('profesores.EMAIL', $email)
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
        $consulta = DB::table('alumnos')
            ->join('empresas', 'empresas.EMAIL', '=', 'alumnos.IDEMPRESA')
            ->select('alumnos.NOMBRE', 'alumnos.APELLIDOS', 'alumnos.EMAIL', 'alumnos.TELEFONO_M', 'alumnos.TELEFONO_F', 'empresas.NOMBRE AS NOMBRE_E', 'empresas.CONVENIO')
            ->where('alumnos.CURSO', $curso)
            ->get();
        return $consulta;
    }

}