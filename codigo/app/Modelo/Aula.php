<?php namespace App\Modelo;
use DB;

/**
 * 
 *
 * @author Ernesto
 */
class Aula {

    private $nombre;

    function __construct($nombre) {

        $this->nombre = $nombre;
    }

    /**
     * Se utiliza para rellenar el imput select.
     * @return array asociativo con los nombres de las aulas ('nombreaula' => 'nombreaula')
     */
    public static function listado() {
        $aulas = array();
        $resultset = DB::table('aulas')->get();
        foreach ($resultset as $var) {
            $aulas[$var->AULA] = $var->AULA;
        }
        return $aulas;
    }
    public static function reservar($email,$aula,$fecha,$horas){
        
                    //primero borrar todas los registros para esa fecha y ese usuario.
        DB::table('reservas')
                ->where('EMAIL', $email)
                ->where('AULA', $aula)
                ->where('FECHA', $fecha)
                ->delete();
        
        if (count($horas) > 0) { //Por si se desmarcan todas las horas para cancelar la reserva.
            foreach ($horas as $hora) {
                DB::table('reservas')->insert(
                        array('EMAIL' => $email, 'AULA' => $aula, 'NUMHORA' => $hora, 'FECHA' => $fecha)
                );
            }
        }
        //Implementar un return en el que se controle si se esta anulando,editando o haciendo una reserva nueva.
    }
                            //CRUD de la tabla aula


    public static function crear_aula($nombre)
    {
        $result = DB::table('aulas')->insert(array('AULA' => $nombre));

        return $result;
    }

    public static function mostrar_aulas()
    {
        $result = DB::table('aulas')->get();

        return $result;

    }

    public static function eliminar_aula($nombre)
    {
        $result = DB::table('aulas')->where('AULA', $nombre)->delete();
        return $result;
    }

    public static function editar_aula($nombre_anterior, $nuevo_nombre)
    {
        $result = DB::table('aulas')
            ->where('AULA', $nombre_anterior)
            ->update(array('AULA' => $nuevo_nombre));
        return $result;
    }

}
