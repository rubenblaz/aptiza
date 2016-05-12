<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Modelo\Asignatura;
use Illuminate\Support\Facades\Input;

use App\Http\Requests\FicheroRequest;


class ImportController extends Controller
{
    public function formImportacion(Request $req)
    {
        $mensaje_error=$req->input('mensaje_error');
        if ($mensaje_error) {
            return view('admin/importDatos', ['mensaje_error' => $mensaje_error]);
        }
        else {
            return view('admin/importDatos');
        }
    }

    public function guardarArchivo(FicheroRequest $req) {
        $name_asignatura = Input::file('fileAsignaturas')->getClientOriginalName();
        $name_alumnos = Input::file('fileAlumnos')->getClientOriginalName();
        $name_profesores = Input::file('fileProfesores')->getClientOriginalName();
        $name_unidades = Input::file('fileUnidades')->getClientOriginalName();
        \Storage::disk('local')->put($name_asignatura,\File::get(Input::file('fileAsignaturas')));
        \Storage::disk('local')->put($name_alumnos,\File::get(Input::file('fileAlumnos')));
        \Storage::disk('local')->put($name_profesores,\File::get(Input::file('fileProfesores')));
        \Storage::disk('local')->put($name_unidades,\File::get(Input::file('fileUnidades')));
           Asignatura::vaciar_datos();
          $result= Asignatura::importar_asignaturas($name_asignatura);
        if(!$result) {
            $mensaje_error="Formato incorrecto del campo asignatura";
            redirect()->action('admin\ImportController@formImportacion', ['mensaje_error' => $mensaje_error]);
        }


    }


}