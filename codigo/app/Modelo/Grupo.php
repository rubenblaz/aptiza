<?php namespace App\Modelo;

use DB;

/**
 * Description of Grupo
 *
 * @author Ernesto
 */
class Grupo {
    
    private $nombre;
    private $curso;
    
    public function __construct() {
        
    }
    
    public function listByProfesor($cod_profesor){
       $result = DB::table('profesor_asignatura')
                ->select('GRUPO')
                ->where('PROFESOR',$cod_profesor)
                ->get();
        foreach ($result as $var){
            $grupos[$var->GRUPO] = $var->GRUPO; 
        }
       return $grupos;
    }
}
