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
    private $asignatura_nombre;
    private $alumnos = array();
    private $evaluacion;
    private $indice = 0;
    
    public function __construct($asignatura,$evaluacion,$alumnos) {
        $this->asignatura = $asignatura;
        $this->evaluacion = $evaluacion;
        $this->alumnos = $alumnos;
    }
    
    public function siguiente(){
        
        if($this->indice < (count($this->alumnos)-1)){
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
    
    public function esUltimo(){
        
        return ($this->indice == count($this->alumnos)-1);
    }
    
    public function esPrimero(){
        return($this->indice == 0);
    }
    
    public function getAsignatura() {
        return $this->asignatura;
    }

    public function getEvaluacion() {
        return $this->evaluacion;
    }
    public function getAsignatura_nombre() {
        return $this->asignatura_nombre;
    }
    public function setAsignatura_nombre($asignatura_nombre) {
        $this->asignatura_nombre = $asignatura_nombre;
    }
    public function getIndice(){
        return $this->indice;
    }
}
