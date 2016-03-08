<?php namespace App\Modelo;

use DB;

class Evaluacion {
    private $evaluacion;
    
    public function __construct(){
        
    }
    
    public static function listEvaluacion(){
    
       $result = DB::table('evaluacion')->get();
       
       foreach($result as $eval){
            $list_eval[] = $eval->COD;
       }
       
       return $list_eval;
    }
}
