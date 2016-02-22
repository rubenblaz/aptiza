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
    private $roles;
    
    function __construct($email,$pass){
        
        $this->email = $email;
        $this->pass = $pass;
    }
    
    public function esValido(){
        $user = null;
        
        $resultado = DB::table('usuarios')
            ->select('NOMBRE','PASS','EMAIL')
            ->where('EMAIL',$this->email)
            ->get();

        if($resultado){
            $dbpass = $resultado[0]->PASS;
            
            $valido = false;
            
            if(Hash::check($this->pass,$dbpass)){
                $valido = true;
            }else if(substr($this->pass,0,4) == '$2y$' && $dbpass == $this->pass){ //Controla si viene de recuperar el pass por email
                    $valido = true;
            }
            
            if($valido){
                $this->nombre = $resultado[0]->NOMBRE;
                $user = $this;
                $this->consultarRoles($this->email);
            }
        }
        
        return ($user); //devuelve el usuario completo con todos los datos de la base de datos.
    }
    
    private function consultarRoles($email){
        
        $roles = array();
        
        $resultado = DB::table('usuariosrol')
                ->select('IDROL')
                ->where('EMAIL',$email)
                ->get();
        
        foreach($resultado as $var){
           
            $roles[] = $var->IDROL;
        }
        
        $this->roles = $roles;
    }
    /**
     * Devuleve "true" si el usuario es administrador y usuario a la vez
     * @param null
     * @return boolean
     */
    public function tieneDobleRol(){
        
        $tiene = false;
        
        if(in_array(0,$this->roles)){
            foreach($this->roles as $rol){
                if($rol > 0){
                    $tiene = true;
                }
            }
        }
        
        return $tiene;
    }
    /**
     * Si se le pasa "true" deja al usuario solo con el rol de Administrador
     * Si se le pasa "false" deja al usuario con los demas roles y le quita el de Administrador
     * @param boolean $opcion
     */
    public function usarComoAdmin($opcion){
      
       $this->consultarRoles($this->email);
            
        if($opcion){
            foreach($this->roles as $key=>$rol){
                if($rol > 0){
                    unset($this->roles[$key]);
                }
            }
        }
        if(!$opcion){
            foreach($this->roles as $key=>$rol){
                if($rol == 0){
                    unset($this->roles[$key]);
                }
            }
        }
    }
    /**
     * Consulta si el usuario tiene un rol determinado
     * @param int (rol)
     * @return boolean
     */
    public function hasRol($rol){
        
        return (in_array($rol,$this->roles));
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
    
    function getEmail() {
        return $this->email;
    }
    
    function setPass($pass){
        $this->pass = $pass;
    }
    //Edicion de usuarios

}
