<?php namespace App\Modelo;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PagAlumnos
 *
 * @author DAW201
 */
class PagAlumnos {
    private $asignatura;
    private $alumnos = array();
    private $evaluacion;
    private $indice = 0;
    
    public function __construct($asignatura,$evaluacion,$alumnos) {
        $this->asignatura = $asignatura;
        $this->evaluacion = $evaluacion;
        $this->alumnos = $alumnos;
    }
    
    public function siguiente(){
        
        if($this->indice < count($this->alumnos)){
            $this->indice++;
        }
    }
    
    public function anterior(){
        
         if($this->indice > 0){
            $this->indice--;
        }
    }
    public function getAlumno(){
        
        return $this->alumnos[$this->indice];
    }
    
    public function esEltimo(){
        
        return ($this->indice == count($this->alumnos)-1);
    }
    
    public function esPrimero(){
        return($this->indice == 0);
    }
    
    function getAsignatura() {
        return $this->asignatura;
    }

    function getEvaluacion() {
        return $this->evaluacion;
    }
}
