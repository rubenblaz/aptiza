<?php namespace App\Modelo;

use DB;
/**
 * Description of Hora
 *
 * @author Ernesto
 */
class Hora {
    
    private $numhora;
    private $hora;
    
    function __construct($numhora,$hora){
        $this->numhora = $numhora;
        $this->hora = $hora;
    }
    /**
     * Se utiliza para rellenar el horario con las horas y saber cuantas hay.
     * @return array asociativo de NUMHORA => HORA. Ejemplo ( '1' => '08:30'). 
     */
    public static function listado(){
        $horas = array();  
        $resultset = DB::table('horas')->get();
            foreach($resultset as $var){
                $horas[$var->NUMHORA] = $var->HORA;
            }
        return $horas;
    }
    function getNumhora() {
        return $this->numhora;
    }

    function getHora() {
        return $this->hora;
    }
}
