<?php namespace App\Modelo;
use DB;

class Valor {
    
    function __construct() {
        
    }

    public function getValores(){
        $result = DB::table('valor')->get();
        
        return $result;
    }
    public function getValoresByApartado($cod){
        $result = DB::table('valor')->where('COD',$cod)->get();
        
        return $result;
    }
    public function getValoresBySeccion($cod){
        $result = DB::table('valor')->where('COD',$cod)->get();
        
        return $result;
    }
}
