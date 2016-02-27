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

    public function cursoTutor($usuario)
    {
        $curso_tutor = DB::table('profesores')
            ->select('CURSO')
            ->where('EMAIL', $usuario)
            ->get();

        return $curso_tutor;
    }

    public function misAlumnos($curso_tutor)
    {
        $alumnos = DB::table('alumnos')
            ->select('N_EXP', 'NOMBRE', 'APELLIDOS', 'CURSO', 'CALIFICACION')
            ->where('CURSO', $curso_tutor[0]->CURSO)
            ->get();

        return $alumnos;
    }
}