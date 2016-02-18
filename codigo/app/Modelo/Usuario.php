<?php namespace App\Modelo;
use DB;
use Hash;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Ernesto
 */
class Usuario {
    
    private $nombre;
    private $pass;
    private $email;
    private $rol;
    
    function __construct($email,$pass){
        
        $this->email = $email;
        $this->pass = $pass;
    }
    
    public function esValido(){
        $user = null;
        
        $resultado = DB::table('usuarios')
            ->select('NOMBRE','PASS','EMAIL','ROL')
            ->where('EMAIL',$this->email)
            ->get();

        if($resultado){
            $dbpass = $resultado[0]->PASS;
            
            $valido = false;
            
            if(Hash::check($this->pass,$dbpass)){
                $valido = true;
            }else if(substr($this->pass,0,4) == '$2y$' && $dbpass == $this->pass){
                    $valido = true;
            }
            
            if($valido){
                $this->nombre = $resultado[0]->NOMBRE;
                $this->rol = $resultado[0]->ROL;
                $user = $this;
            }
        }
        return ($user); //devuelve el usuario completo con todos los datos de la base de datos.
    }
    
    /**
     * Este método se utiliza en el formulario de solicitar contraseña para 
     * comprobar si el usuario existe en la base de datos.
     * @param type $email
     * @return type
     */
    static function existeUsuario($email){
        
        $resultado = DB::table('usuarios')
                ->select('EMAIL')
                ->where('EMAIL',$email)
                ->get();
       
        return $resultado;
    }
    public function nuevoPass($pass){
        
        DB::table('usuarios')
                ->where('EMAIL',$this->email)
                ->update(['PASS' => Hash::make($pass)]);
        $this->pass = $pass;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    function getPass() {
        return $this->pass;
    }
    
    function getRol(){
        return $this->rol;
    }

    function getEmail() {
        return $this->email;
    }
    
    function setPass($pass){
        $this->pass = $pass;
    }


}
