<?php namespace App\Modelo;
use DB;
use League\Csv\Reader;

class Asignatura {

    private $materia;
    private $descripcion;
    private $abreviatura;
    private $curso;


    function __construct() {
    }
    public static function importar_asignaturas($ficheroAsignatura)
    {
        $datosAsignatura='';
        $reader = Reader::createFromPath('csv/'.$ficheroAsignatura);
        $offset = 0;
        $results = $reader->fetchAssoc($offset);
        $resultado=0;
        foreach ($results as $row) {
            $datosAsignatura[]=$row;
        }
        $valido=self::comprobarFormato($datosAsignatura);
        if($valido) {
            foreach ($datosAsignatura as $fila) {
                $resultado = DB::table('Materias')->insert(array('MATERIA' => $fila['MATERIA'],
                    'DESCRIPCION' => $fila['DESCRIPCION'], 'ABREVIATURA' => $fila['ABREVIATURA'],
                    'CURSO' => $fila['CURSO']));
            }
            return $resultado;
        }
        else {
            return $resultado;

        }

    }
    public static function vaciar_datos() {
        DB::table('Materias')->delete();
    }
private static function comprobarFormato($datosAsignatura) {
    $valido=true;
    $nombres_campos=array('MATERIA','DESCRIPCION','ABREVIATURA','DEPARTAMENTO','CURSO');
    foreach($datosAsignatura[0] as $key=>$value){
        if(!in_array( $key,$nombres_campos))
            $valido=false;

    }
    return $valido;

}

}
