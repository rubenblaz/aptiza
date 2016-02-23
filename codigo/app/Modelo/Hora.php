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
    //CRUD tabla hora
    public static function crear_hora($hora)
    {
    $count= DB::table('horas')->count();
        $result = DB::table('horas')->insert(array('HORA' => $hora,'NUMHORA'=>$count+1));

        return $result;
    }

    public static function mostrar_horas()
    {
        $result = DB::table('horas')->orderBy('HORA','asc')->get();
        return $result;
    }

    public static function eliminar_hora($num_hora)
    {
        $result = DB::table('horas')->where('NUMHORA', $num_hora)->delete();
        return $result;
    }

    public static function editar_hora($id_hora, $nueva_hora)
    {
        $result = DB::table('horas')
            ->where('NUMHORA', $id_hora)
            ->update(array('HORA' => $nueva_hora));
        return $result;
    }
}
