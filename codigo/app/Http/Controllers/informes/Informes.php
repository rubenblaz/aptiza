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
use DB;

class Informes extends Controller {

    public function elegirGrupo() {

        $profe = new Profesor(Session::get('USUARIO')->getEmail());

        $grupos = (new Grupo())->listByProfesor($profe->getCod());

        $datos['grupos'] = $grupos;
        $datos['grupo'] = ($grupo = array_keys($grupos)[0]);
        
        $eval = Evaluacion::listEvaluacion();
        $datos['evaluaciones'] = $eval;
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
        
        return redirect('informes/calificarAlumno/inicio');
    }
    public function calificarAlumno(Request $request){  
        
        if($request->PAG == 'sig'){
            Session::get('PAGINACION')->siguiente();
        }
        if($request->PAG == 'ant'){
            Session::get('PAGINACION')->anterior();
        }
        
        $datos['nombre'] = Alumno::getNombreByCod(Session::get('PAGINACION')->getAlumno());
        $datos['secciones'] = $this->secciones();
        $datos['valores']  = $this->valores();
        $datos['apartados'] = $this->apartados();
        
        return view('informes/calificar',$datos);
    }
    
    private function valores(){
        
        $result = DB::table('valor')->get();
        
        return $result;
    }
    private function secciones(){
        $result = DB::table('seccion')->get();
        
        return $result;
    }
    private function apartados(){
        $result = DB::table('apartado')->get();
        
        return $result;
    }
    
    public function generarInforme(Request $request){
        
        $profesor_cod = (new Profesor(Session::get('USUARIO')->getEmail()))->getCod();
        $paginacion = Session::get('PAGINACION');
        $calificacion = $request->all();
        array_shift($calificacion); //elimina el token del resquest al devolver request->all()
        $informe = new Informe(111,$paginacion->getAsignatura(),$profesor_cod,$paginacion->getAlumno(),$paginacion->getEvaluacion(),$calificacion);
        
        $informe->guardar();
    }
    
}
