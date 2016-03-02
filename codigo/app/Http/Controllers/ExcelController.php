<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Modelo\profesor;
use Session;
use Illuminate\Support\Facades\DB;

class ExcelController extends Controller
{
    public function generar_excel(){
        $profesor1 = new profesor();

        $email_profesor = Session::get('USUARIO')->getEmail();
        $nombre_apellidos_tutor = $profesor1->obtenerNombreApellidos($email_profesor);
        $nombre_curso_tutor = $profesor1->nombreCurso($email_profesor)[0]->CICLO;
        $id_curso_tutor = $profesor1->cursoTutor($email_profesor)[0]->CURSO;

        $nombre = $nombre_apellidos_tutor[0]->NOMBRE;
        $apellidos = $nombre_apellidos_tutor[0]->APELLIDOS;
        $mis_alumnos = $profesor1->misAlumnos2($id_curso_tutor);


        Session::put('nombre_tutor', $nombre);
        Session::put('apellidos_tutor', $apellidos);
        Session::put('nombre_grupo', $nombre_curso_tutor);

        $datos = [
            'mis_alumnos' => $mis_alumnos
        ];



    }
}
