<?php namespace App\Modelo;


use DB;
/**
 * Description of Alumno
 *
 * @author Ernesto
 */
class Alumno {
    private $cod;
    private $nombre;
    private $apellidos;
    private $email;
    
    
    function __construct($cod, $nombre, $apellidos, $email) {
        $this->cod = $cod;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
    }

    static function byCodigo($codigo){

    $result = DB::table('alumno')
            ->where('COD',$codigo)
            ->get();

    $datos = $result[0];
    $this->cod = $datos->COD;
    $this->nombre = $datos->NOMBRE;
    $this->apellidos = $datos->APELLIDOS;
    $this->email = $datos->EMAIL;
    }
    
    static function listByGrupo($grupo){
        
        $result = DB::table('alumno')
                ->join('matricula','alumno.COD','=','matricula.ALUMNO')
                ->where('GRUPO',$grupo)
                ->select('alumno.COD','NOMBRE','APELLIDOS','EMAIL')
                ->get();
        
        $list = array();
        
        foreach($result as $alum){
           
            $list[] = new Alumno($alum->COD, $alum->NOMBRE, $alum->APELLIDOS, $alum->EMAIL);
        }
      
        return $list;
    }
    function getCod() {
        return $this->cod;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}
