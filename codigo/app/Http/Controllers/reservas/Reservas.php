<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo\Aula;
use App\Modelo\Hora;
use App\Modelo\Reserva;
use App\Http\Controllers\Controller;
use Session;
use DB;

class Reservas extends Controller
{
    
    public function store(Request $request){
        
         $datos['aulas'] = Aula::listado();
         $datos['horario'] = Hora::listado();
         
         
         //Datos de editar de Misreservas
         if($request->input('aula') != null){
             $datos['aulaselec'] = $request->input('aula');
         }else{
             $datos['aulaselec'] = next($datos['aulas']);//Devuelve la primera posición de un array asociativo sin saber la clave
         }
         if($request->input('fecha') != null){
             $datos['fecha'] = $request->input('fecha');
         }
         
         //Redireccionamiento de mensajes si existen
         if($request->input('mensaje') != null){
         $datos['mensaje'] = $request->input('mensaje');  
         $datos['tipomensaje'] = $request->input('tipomensaje');
         }
         
        //Se utiliza para pasar una aula seleccionada por defecto.
         return view('reservas/reserva',$datos);
    }
   public function ajaxconsulta(Request $request){
        
        $fecha = date_create($request->input('fecha'));
        $fecha = date_format($fecha, 'Y-m-d');

        $aula = $request->input('aula');

        $horas = array();
        
        $resultset = DB::table('reservas')
                        ->join('usuarios','reservas.EMAIL','=','usuarios.EMAIL')
                        ->select('NUMHORA','usuarios.NOMBRE','reservas.EMAIL')
                        ->where('FECHA',$fecha)
                        ->where('AULA',$aula)
                        ->get();
        
        foreach($resultset as $var){
                $horas[$var->NUMHORA] = array('nombre'=>$var->NOMBRE,'email'=>$var->EMAIL);
            }
        $datos  = json_encode($horas);
      
        return $datos;
    }
    public function hacerReserva(Request $request){
        
        $fecha = $request->input('fecha');
        $horas = $request->input('horas');
        $aula =$request->input('aula');
        $email = Session::get('USUARIO')->getEmail();
        
        Aula::reservar($email,$aula,$fecha,$horas);
        
        return redirect()->action('Reservas@store', ['fecha'=> $fecha,'aula'=>$aula,'tipomensaje'=>'ok','mensaje' => 'Reserva del aula '.$aula.' para el dia '.$fecha.' realizada correctamente']);
    }
    public function misreservas(){
        
        $datos = array('misreservas' => Reserva::listar(Session::get('USUARIO')->getEmail()));
        
        return view('reservas/misreservas',$datos);
    }
    public function reservaborrar(Request $request){
        
        Reserva::eliminar($request->input('fecha'),$request->input('aula') , Session::get('USUARIO')->getEmail());
        
        return redirect()->action('Reservas@misreservas');
    }
}
