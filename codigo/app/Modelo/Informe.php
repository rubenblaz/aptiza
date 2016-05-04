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
    /**
     * Devuelve las asignaturas de un grupo pasandole el tutor.
     * @param type $cod, es el código del tutor que será el del profesor que este guardado en la session.
     * @return Array asociativo [CODASIGNATURA => NOMBREASIGNATURA]
     */
    static public function getAsignaturas($cod){
        $result = DB::table('grupo')->join('asignatura','grupo.CURSO','=','asignatura.CURSO')
                ->where('TUTOR',$cod)
                ->lists('asignatura.NOMBRE','COD');
    
        return $result;
    } 
    static public function getValores(){
        $result = DB::table('valor')->get();
        
        return $result;
    }
    /**
     * Funcion estática que anida los datos obtenidos de una sola query que une las tablas "seccion,apartado,valor" en una sola consulta.
     * Produce un arbol con ramificaciones [seccion->[apartado->[valor]]]
     * @return type Devuelve una matriz con la jerarquia del informe.
     */
    static public function InformeCompleto(){
        $consulta = DB::table('seccion')
                    ->join('apartado','apartado.SECCION','=','seccion.COD')
                    ->join('valor','valor.APARTADO','=','seccion.COD')
                    ->select('seccion.COD as SECCIONCOD','seccion.NOMBRE as SECCIONNOMBRE','apartado.COD as APARTADOCOD','apartado.SECCION as APARTADOSECCION','apartado.NOMBRE as APARTADONOMBRE','valor.COD as VALORCOD','valor.NOMBRE as VALORNOMBRE','valor.APARTADO as VALORAPARTADO')
                    ->get();
        $informe = array();$i = 0;
        function getApartados($seccion,$consulta){
            $listado = array();$i=0;
            foreach($consulta as $apartado){
                if($seccion == $apartado->APARTADOSECCION && end($listado)['NOMBRE']!=$apartado->APARTADONOMBRE){
                    $listado[$i]['COD'] = $apartado->APARTADOCOD;
                    $listado[$i]['NOMBRE'] = $apartado->APARTADONOMBRE;
                    $listado[$i]['VALORES'] = getValores($apartado->SECCIONCOD,$consulta);
                    $i++;
                }
            }
            return $listado;
        }
        function getValores($apartado,$consulta){
            $i=0;$listado = array();
            foreach($consulta as $valor){
                if($apartado == $valor->VALORAPARTADO && end($listado)['COD']!= $valor->VALORCOD && !in_array($valor->VALORCOD,array_column($listado,'COD'))){
                    $listado[$i]['COD']= $valor->VALORCOD;
                    $listado[$i]['NOMBRE'] = $valor->VALORNOMBRE;
                    $i++;
                }         
            }
                return $listado;
        }
        foreach($consulta as $key=>$seccion){
           if($key == 0 || end($informe)['COD'] != $seccion->SECCIONCOD){
               $informe[$i]['COD']= $seccion->SECCIONCOD;
               $informe[$i]['NOMBRE'] = $seccion->SECCIONNOMBRE;
               $informe[$i]['APARTADOS'] = getApartados($seccion->SECCIONCOD,$consulta);
               $i++;
           }
        }
        return $informe;
    }
}