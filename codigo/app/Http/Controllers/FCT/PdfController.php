<?php

namespace App\Http\Controllers\FCT;

use App\Modelo\profesor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modelo\alumno;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Modelo\metodos;
use Session;

class PdfController extends Controller
{
    public function invoice()
    {
        $metodos1 = new metodos();
        $data = $this->getData();
        //$date = date('Y-m-d');
        $dia = date('d');
        $mes = date('M');
        $anio = date('Y');
        $mes1 = $metodos1->convertirMes($mes);
        $curso1 = $metodos1->cursoTutor();
        $curso2 = $curso1[0]->CICLO;
        $date = "Puertollano a " . $dia . " de " . $mes1 . " de " . $anio;
        $invoice = "Informes para alumnos de FCT";
        $view = \View::make('FCT/invoice', compact('data', 'date', 'invoice', 'curso2'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('FCT/invoice');
    }

    public function getData()
    {
        $alumno1 = new alumno();
        $profesor1 = new profesor();

        $curso_tutor = $profesor1->cursoTutor(Session::get('USUARIO')->getEmail());
        $alumnos = $alumno1->obtenerDatosAlumnos($curso_tutor);
        $alumnos_v = array();

        foreach ($alumnos as $al) {
            $alumnos_v[] = "<tr>" . "<td>" . $al->NOMBRE . " " . $al->APELLIDOS . "</td>" . "<td></td>" . "</tr>";
        }
        $data2 = " ";

        for ($i = 0; $i < count($alumnos_v); $i++) {
            $data2 = $data2 . $alumnos_v[$i];
        }

        $data = [
            'alumnos' => $data2
        ];
        return $data;
    }
}
