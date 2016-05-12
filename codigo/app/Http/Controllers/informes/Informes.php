<?php namespace App\Http\Controllers\informes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo\Profesor;
use App\Modelo\Grupo;
use App\Modelo\Alumno;
use App\Modelo\Asignatura;
use App\Modelo\Evaluacion;
use App\Modelo\PagAlumnos;
use App\Modelo\Informe;
use Session;
use View;
use App;
use App\Modelo\Calificacion;

class Informes extends Controller {

    public function elegirGrupo() {

        $profe = new Profesor(Session::get('USUARIO')->getEmail());

        $grupos = Grupo::listByProfesor($profe->getCod());

        $datos['grupos'] = $grupos;
        $datos['grupo'] = ($grupo = array_keys($grupos)[0]);
        
        $datos['evaluaciones'] = Evaluacion::listEvaluacion();
        return view('informes\elegirGrupo', $datos);
    }

    public function ajaxAlumnos(Request $request) {
        $json = array();

        $profe = new Profesor(\Session::get('USUARIO')->getEmail());
        
        $asignaturas = Asignatura::byProfesor($profe->getCod());
        
        foreach($asignaturas as $key=>$asig){
            if($asig->GRUPO == $request->input('grupo')){
                $json['ASIGNATURA_'.$key ] = ['COD'=>$asig->COD,'NOMBRE'=>$asig->NOMBRE,'GRUPO'=>$asig->GRUPO];
            }
        }
          
        $lista = Alumno::listByGrupo($request->input('grupo'));

        foreach ($lista as $key=>$alum) {
            $json['ALUMNO_'.$key] = ['COD' => $alum->getCod(), 'NOMBRE' => $alum->getNombre(),'APELLIDOS' => $alum->getApellidos()];
        }
        
        return json_encode($json);
    }
    public function calificar(Request $request){
        
        $paginacion = new PagAlumnos($request->input('asignatura'),$request->input('evaluacion'),$request->input('alumnos'));
        
        $paginacion->setAsignatura_nombre(Asignatura::nombreByCod($request->input('asignatura')));
        
        Session::put('PAGINACION',$paginacion);
        
        return redirect('informes/calificarAlumno');
    }
    public function calificarAlumno(Request $request){  
       
        if(isset($request->PAG)){
            if($request->PAG == 'sig'){
                Session::get('PAGINACION')->siguiente();
            }
            if($request->PAG == 'ant'){
                Session::get('PAGINACION')->anterior();
            }
        }
        $datos['nombre'] = Alumno::ByCodigo(Session::get('PAGINACION')->getAlumno())->getNomCompleto();
        $datos['modeloinforme'] = Informe::InformeCompleto();
       
        return view('informes/calificar',$datos);
    }
    
    public function crearInforme(Request $request){
        
        $profesor_cod = (new Profesor(Session::get('USUARIO')->getEmail()))->getCod();
        $paginacion = Session::get('PAGINACION');
        $calificacion = $request->all();
        array_shift($calificacion); //elimina el token del resquest al devolver request->all()
        $informe = new Informe(null,$paginacion->getAsignatura(),$profesor_cod,$paginacion->getAlumno(),$paginacion->getEvaluacion(),$calificacion);
        
        $informe->guardar();
       
        return redirect('\informes\calificarAlumno')->with('mensaje', 'Calificación guardada correctamente para ');  
    }
    public function generarInforme(Request $request){
        
        $request->exists('evaluacion')? $eval = $request->get('evaluacion') : $eval = 1;
       
        $profesor = new Profesor(Session::get('USUARIO')->getEmail());
        
        $lista_alumnos = Alumno::listByInforme($profesor->grupoTutor(),$eval);
        
        $datos['actualeval'] = $eval;
        $datos['evaluaciones'] = Evaluacion::listEvaluacion();
        $datos['alumnos'] = $lista_alumnos;
        $datos['calificacion'] = new Calificacion($eval,Grupo::getGrupoTutor($profesor->getCod()));
        
        return view('informes/generarInforme',$datos);
    }
    public function generarPDF(Request $request){
        
        $profesor = new Profesor(Session::get('USUARIO')->getEmail());
        
        $asignaturas = Informe::getAsignaturas($profesor->grupoTutorCod());
        $modeloinforme = Informe::InformeCompleto();
 
        $calificacion = new Calificacion($request->EVAL,Grupo::getGrupoTutor($profesor->getCod()));
        $calificacion->setAlumno($request->COD);
        
        $vista = View::make('informes.pdf.informePdf',compact('asignaturas','modeloinforme','calificacion'))->render();

        $pdf = App::make('dompdf.wrapper');
        
        $pdf->loadHTML($vista);

        return $pdf->stream('Informe_'.$calificacion->getAlumno()->getNomCompleto().'.pdf'); //nombre del pdf //Con "donwload" en vez de "stream" se crea una descarga.   
    }
}
