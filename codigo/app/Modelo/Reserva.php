<?php namespace App\Modelo;

/**
 * Description of Reserva
 *
 * @author Ernesto
 */
use App\Modelo\Hora;
use DB;

class Reserva {
    
    private $fecha;
    private $aula;
    private $email;
    private $horas = array();
    
    function __construct($fecha,$aula,$email) {
        
       $this->fecha = $fecha;
       $this->aula = $aula;
       $this->email = $email;
       $this->horas = $this->listHoras($this->fecha,$this->email,$this->aula);
      
    }
    
    private function listHoras($fecha,$email,$aula){
       
        $resulset = DB::table('reservas')
                ->join('horas','reservas.NUMHORA','=','horas.NUMHORA')
                ->select('reservas.NUMHORA','HORA')
                ->where('FECHA',$fecha)
                ->where('EMAIL',$email)
                ->where('AULA',$aula)
                ->get();
       
        $horaslist = array();
        
        foreach($resulset as $result){
            $horaslist[] = new Hora($result->NUMHORA,$result->HORA);
        }
        
        return $horaslist;
    }
    
    static function listar($email){
        
        $reservas = array();
        
        $resulset = DB::table('reservas')
                ->select('FECHA','AULA','EMAIL')
                ->where('EMAIL',$email)                                     //CURDATE() - INTERVAL 1 DAY función que devuelve el dia de ayer.
                ->where('FECHA','>',DB::raw('CURDATE() - INTERVAL 1 DAY')) //En fluent las funciones de MYSQL hay que llamarlas así.Excluye las reservas que ya han pasado.
                ->groupBy('FECHA')
                ->groupBy('AULA')//Solo selecciona una fecha descartando todos los registros duplicados por horas.
                ->get();
     
        foreach($resulset as $result){
            
            $reservas[] = new Reserva($result->FECHA, $result->AULA, $result->EMAIL);
        }
     
        return $reservas;
    }
    
    static function eliminar($fecha,$aula,$email){
        
        DB::table('reservas')
                ->where('FECHA',$fecha)
                ->where('AULA',$aula)
                ->where('EMAIL',$email)
                ->delete();
    }
    
    function getFecha() {
        return $this->fecha;
    }

    function getAula() {
        return $this->aula;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getHoras() {
        return $this->horas;
    }
}
