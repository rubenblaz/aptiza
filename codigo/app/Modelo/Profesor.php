<?php namespace App\Modelo;

use DB;
/**
 * Description of Profesor
 *
 * @author Ernesto
 */
class Profesor {
    
    private $cod;
    private $nombre;
    private $apellidos;
    private $email;
    
    public function __construct($email) {
        $datos = $this->obtenerDatos($email);
      
        $this->cod = $datos->COD;
        $this->nombre = $datos->NOMBRE;
        $this->apellidos = $datos->APELLIDOS;
        $this->email = $datos->EMAIL;
    }
    
    private function obtenerDatos($email){
        
        $result  = DB::table('profesor')->where('EMAIL', $email)->get();
        
        return $result[0];
    }
    
    function getCod(){
        return $this->cod;
    }   
}