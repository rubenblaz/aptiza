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

    $r = DB::table('alumno')
            ->where('COD',$codigo)
            ->get();

        $c = $r[0];
        return new Alumno($c->COD,$c->NOMBRE,$c->APELLIDOS,$c->EMAIL);
    }
    
    static function listByGrupo($grupo){ //En un futuro filtrar tambien por asignatura
        
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
    static function listByInforme($grupo,$eval){
        
        $lista_alumno = array();
        
        $result = DB::table('alumno')
               // ->join('informe','informe.ALUMNO','=','alumno.COD')
                ->join('matricula','matricula.ALUMNO','=','alumno.COD')
                ->where('GRUPO',$grupo)
                //->where('EVALUACION',$eval)
                ->select('alumno.COD','NOMBRE','APELLIDOS','EMAIL')
                ->groupBy('alumno.COD')
                ->get();
       
        foreach($result as $r){
            $lista_alumno[] = new Alumno($r->COD,$r->NOMBRE,$r->APELLIDOS,$r->EMAIL);
        }
        return $lista_alumno;
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
//    static function getNombreByCod($cod){
//        $result = DB::table('alumno')
//                ->where('COD',$cod)
//                ->select('NOMBRE','APELLIDOS')
//                ->get();
//        
//        return $result[0]->NOMBRE.' '.$result[0]->APELLIDOS;
//    }
    function getNomCompleto(){
        return $this->nombre.' '.$this->apellidos;
    }
}
