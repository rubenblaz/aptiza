<?php
/**
 * Created by PhpStorm.
 * User: Ángel
 * Date: 24/02/2016
 * Time: 11:53
 */

namespace app\Modelo;

use App\Modelo\alumno;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use App\Modelo\empresa;

class encuesta
{

    /**
     * encuesta constructor.
     */
    public function __construct()
    {
    }

    public function obtenerPreguntasEmpresas()
    {
        $preguntas = DB::table('tiene')
            ->join('modelo_pregunta', 'modelo_pregunta.IDPREGUNTA', '=', 'tiene.IDMPREGUNTA')
            ->select('modelo_pregunta.*')
            ->where('tiene.IDMENCUESTA', 2)
            ->where('modelo_pregunta.TEXTO', '!=', 'Aspectos de mejora')
            ->where('modelo_pregunta.TEXTO', '!=', 'Aspectos positivos')
            ->orderBy('modelo_pregunta.TIPO')
            ->get();

        return $preguntas;
    }

    public function obtenerPreguntasAlumnos(){
        $preguntas = DB::table('tiene')
            ->join('modelo_pregunta', 'modelo_pregunta.IDPREGUNTA', '=', 'tiene.IDMPREGUNTA')
            ->select('modelo_pregunta.*')
            ->where('tiene.IDMENCUESTA', 1)
            ->where('modelo_pregunta.TEXTO', '!=', 'Aspectos de mejora')
            ->where('modelo_pregunta.TEXTO', '!=', 'Aspectos positivos')
            ->orderBy('modelo_pregunta.TIPO')
            ->get();

        return $preguntas;
    }
}