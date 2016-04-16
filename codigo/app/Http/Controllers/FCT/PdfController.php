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
    /**
     * @return mixed
     * Genera el PDF de las hojas de firmas de FCT.
     */
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
        $curso2 = $curso1[0]->NOMBRE;
        $date = "Puertollano a " . $dia . " de " . $mes1 . " de " . $anio;
        $invoice = "Informes para alumnos de FCT";
        $view = \View::make('FCT/invoice', compact('data', 'date', 'invoice', 'curso2'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('FCT ' . $curso2);
    }

    /**
     * @return array
     * Obtiene los datos para pasarselos luego a la vista
     */
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

    /**
     * @param Request $req
     * @return mixed
     * Genera el PDF de la memoria final.
     */
    public function invoice2(Request $req)
    {

        $nombre_tutor = $req->get('nombre_tutor');
        $nombre_grupo = $req->get('nombre_grupo');
        $curso_academico = $req->get('curso_academico');
        $nombre_apellidos_alumnos = $req->get('nombre_apellidos');
        $nombre_empresas = $req->get('nombre_e');
        $convenios = $req->get('convenio');
        $telefonos_m = $req->get('telefono_m');
        $telefonos_f = $req->get('telefono_f');
        $emails = $req->get('email');
        $fechas_inicio = $req->get('fecha_inicio');
        $fechas_fin = $req->get('fecha_fin');
        $aptos = $req->get('aptos');

        $alumnos = array();
        $datosv = array();

        $datosv = [
            'nombre_tutor' => $nombre_tutor,
            'nombre_grupo' => $nombre_grupo,
            'curso_academico' => $curso_academico
        ];
        for ($i = 0; $i < count($nombre_apellidos_alumnos); $i++) {
            $alumnos[$i] = [
                'nombre_apellidos_alumnos' => $nombre_apellidos_alumnos[$i],
                'nombre_empresas' => $nombre_empresas[$i],
                'convenios' => $convenios[$i],
                'telefonos_m' => $telefonos_m[$i],
                'telefonos_f' => $telefonos_f[$i],
                'emails' => $emails[$i],
                'fechas_inicio' => $fechas_inicio[$i],
                'fechas_fin' => $fechas_fin[$i],
                'aptos' => $aptos[$i]
            ];
        }

        $metodos1 = new metodos();
        $dia = date('d');
        $mes = date('M');
        $anio = date('Y');
        $mes1 = $metodos1->convertirMes($mes);
        $date = "Puertollano a " . $dia . " de " . $mes1 . " de " . $anio;
        $invoice = "Memoria final de FCT.";
        $view = \View::make('FCT/invoice2', compact('data', 'date', 'invoice', 'alumnos', 'datosv'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Memoria final de FCT.');
    }
}
