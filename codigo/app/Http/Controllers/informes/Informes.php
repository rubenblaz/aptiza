<?php namespace App\Http\Controllers\informes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelo\Profesor;
use App\Modelo\Grupo;
use App\Modelo\Alumno;
use App\Modelo\Asignatura;
use App\Modelo\Evaluacion;

class Informes extends Controller {

    public function elegirGrupo() {

        $profe = new Profesor(\Session::get('USUARIO')->getEmail());

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
    public function elegirAlumnosPag(Request $request){
        
        dd($request->get('alumnos'));
        
        
        
    }
}
