<?php namespace App\Modelo;

use DB;

/**
 * Description of Informe
 *
 * @author Ernesto
 */
class Informe {
    private $cod;
    private $asignatura;
    private $profesor;
    private $alumno;
    private $evaluacion;
    private $calificacion = array();
    private $correcto = false;
    
    function __construct($cod, $asignatura, $profesor, $alumno, $evaluacion, $calificacion) {
        $this->cod = $cod;
        $this->asignatura = $asignatura;
        $this->profesor = $profesor;
        $this->alumno = $alumno;
        $this->evaluacion = $evaluacion;
        $this->calificacion = $calificacion;
    }
    
    public function guardar(){
        $cod_informe = $this->alumno.$this->asignatura.$this->evaluacion;
        
        $old_informe = DB::table('informe')
                       ->where('COD',$cod_informe)->get();
       
        if(count($old_informe) > 0){
            $this->actualizar_calificacion($cod_informe);
        }else{
            $this->nuevo_informe($cod_informe);
        }
    }
    private function nuevo_informe($cod_informe){
       
        $this->correcto = DB::table('informe')->insert(
        array(
            'COD'=>$cod_informe,
            'ASIGNATURA'=>$this->asignatura,
            'PROFESOR'=>$this->profesor,
            'ALUMNO'=>$this->alumno,
            'EVALUACION'=>$this->evaluacion,
            )   
        );
        
        $this->nueva_calificacion($cod_informe);
    }
    
    private function nueva_calificacion(){
        $this->recorr_calificacion($this->calificacion,1,0);//Apartado de inicio y subniveles de array.
    }
    /**
     * Recorrido recursivo de la estructura de arrays donde se 
     * guardan los apartados con su valores. Sistema estandarizado
     * @param type $vector -> Array a recorrer.
     * @param type $apart -> Numero del apartado inicial, por defecto 0
     * @param type $n -> numero de subnivel de array, por defecto 0
     */
    private function recorr_calificacion($vector,$apart,$n){ 
       
        $nivel = $n; //subnivel de arrays anidados en el que encuentra en ese momento.
        $apartado = $apart; //apartado inicial que se va incrementando
        foreach($vector as $key=>$value){
            if($nivel == 0 && !is_array($value) && $apartado == 3){//Controla que el apartado 3 no tenga opciones que añadir.
                $apartado++;
            }
            if(is_array($value)){
                $this->recorr_calificacion($value,$apartado,($nivel +1));
            }else{
                $this->insert_apartado_calificacion(($this->alumno.$this->asignatura.$this->evaluacion),$apartado,$value);
            }
            if($nivel == 0){
                $apartado++;
            } 
        }
    }
    private function insert_apartado_calificacion($cod_informe,$apartado,$valor){
        DB::table('informe_calificacion')->insert(
            array(
                'INFORME'=>$cod_informe,
                'APARTADO'=>$apartado,
                'VALOR'=>$valor,
            )    
        );
    }
   
    private function actualizar_calificacion($cod_informe){
        
        DB::table('informe_calificacion')->where('INFORME',$cod_informe)->delete();
      
        $this->nueva_calificacion();
    }
    static public function getApartados(){
        $result = DB::table('apartado')->get();
        
        return $result;
    }
}