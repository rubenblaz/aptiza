<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 16/02/16
 * Time: 13:22
 */

namespace app\Modelo;

use Session;
use Illuminate\Support\Facades\DB;
class metodos
{

    /**
     * metodos constructor.
     */
    public function __construct()
    {
    }

    public function convertirMes($mes)
    {
        switch ($mes) {
            case "Jan":
                $mes = "Enero";
                break;
            case "Feb":
                $mes = "Febrero";
                break;
            case "Mar":
                $mes = "Marzo";
                break;
            case "Apr":
                $mes = "Abril";
                break;
            case "May":
                $mes = "Mayo";
                break;
            case "Jun":
                $mes = "Junio";
                break;
            case "Jul":
                $mes = "Julio";
                break;
            case "Aug":
                $mes = "Agosto";
                break;
            case "Sep":
                $mes = "Septiembre";
                break;
            case "Oct":
                $mes = "Octubre";
                break;
            case "Nov":
                $mes = "Noviembre";
                break;
            case "Dec":
                $mes = "Diciembre";
                break;
        }
        return $mes;
    }

    public function cursoTutor()
    {
        $consulta = DB::table('cursos')
            ->join('profesores', 'cursos.IDCICLO', '=', 'profesores.CURSO')
            ->select('cursos.CICLO')
            ->where('profesores.EMAIL', \Session::get('usuario'))
            ->get();
        return $consulta;
    }


}