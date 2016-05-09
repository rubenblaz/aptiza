<?php

namespace App\Modelo;

/**
 * Description of Calificacion
 *
 * @author Ernesto
 */
use DB;

class Calificacion {

    private $eval;
    private $calific;

    function __construct($eval) {
        $this->eval = $eval;
    }
    public function setAlumno($alumno) {

        $this->calific = DB::table('informe')->join('informe_calificacion', 'informe_calificacion.INFORME', '=', 'informe.COD')
                ->join('valor','valor.COD','=','informe_calificacion.VALOR')
                ->where('ALUMNO', $alumno)
                ->where('EVALUACION', $this->eval)
                ->select('informe.ASIGNATURA','informe_calificacion.APARTADO','informe_calificacion.VALOR')
                ->get();
    }

    public function getValor($asignatura, $apartado) {
        $valor = null;

        foreach (array_keys(array_column(json_decode(json_encode($this->calific), true), 'APARTADO'), $apartado) as $i) {
            if ($this->calific[$i]->ASIGNATURA == $asignatura) {
                $valor = $this->calific[$i]->VALOR;
            }
        }
        return $valor;
    }
    public function esIgualValor($asignatura, $apartado, $valor) {
        $coincide = false;

        foreach (array_keys(array_column(json_decode(json_encode($this->calific), true), 'APARTADO'), $apartado) as $i) {
            if ($this->calific[$i]->ASIGNATURA == $asignatura && $this->calific[$i]->VALOR == $valor) {
                $coincide = true;
            }
        }
        return $coincide;
    }
    public function getValorNombre($asignatura, $apartado) {
        $valor = null;

        foreach (array_keys(array_column(json_decode(json_encode($this->calific), true), 'APARTADO'), $apartado) as $i) {
            if ($this->calific[$i]->ASIGNATURA == $asignatura) {
                $valor = $this->calific[$i]->NOMBRE;
            }
        }
        return $valor;
    }
    public function esCompleta($alumno){
        
        $consulta = DB::table('informe')
                    ->where('ALUMNO','=',$alumno)
                    ->where('EVALUACION','=',$this->eval)
                    ->select(DB::raw('count(*) =
            (select count(*) from 
                    asignatura,grupo,matricula 
                    where matricula.GRUPO  = grupo.NOMBRE and asignatura.CURSO = grupo.CURSO 
                    and matricula.ALUMNO = 9818) as TODOCALIFICADO'))
                    ->get();
        
        return $consulta[0]->TODOCALIFICADO;    
    }

}
