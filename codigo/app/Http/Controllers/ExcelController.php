<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Modelo\profesor;
use Session;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Writers\CellWriter;

class ExcelController extends Controller
{
    public function store(Request $req)
    {
        /**
         * Recogida de datos del formulario.
         */
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

        //dd($alumnos);

        /**
         * Function para crear el archivo excel.
         * Aqui jugaremos con las hojas del documento y las celdas.
         * Podemos aplicarles atributos y sus valores.
         */
        Excel::create('Memoria final', function ($excel) use ($alumnos) { //Con el parámetro "use" le podemos pasar variables externas en este caso los $alumnos
            $excel->sheet('Memoria final FCT', function ($sheet) use ($alumnos) {
                $sheet->row(1, array('ALUMNO', 'EMPRESA', 'CONVENIO', 'TELEFONO MOVIL', 'TELEFONO FIJO', 'EMAIL', 'FECHA INICIO', 'FECHA FIN', '¿APTO?')); //En la fila una ponemos los nombres de las cabeceras
                $sheet->cells('A1:I1', function ($cells) { //Rango de las celdas que vamos a modificar
                    $cells->setBackground('#abebc6'); //Setea el color de fondo de las celdas A1:C1
                    $cells->setAlignment('center'); //Alineación del texto de las celdas A1:C1
                });
                //Recorremos los alumnos y vamos rellenando las celdas en las distintas filas con los datos del array asociativo.
                for ($i = 0; $i < count($alumnos); $i++) {
                    $sheet->row($i + 2, $alumnos[$i]);
                }
                $sheet->setBorder('A1:I10', 'thin'); //Dibujamos el borde de la tabla al rango de celdas que queramos.
                $sheet->setAutoSize(true); //Le decimos que el tamaño del documento será automático.
            });
        })->export('xls'); //Formato del archivo que se generará para guardar o ver.
    }
}

/**
 * Excel::create('Ejemplo excel', function ($excel) use ($datos) {
 * $excel->sheet('Ejemplo hoja 1', function ($sheet) use ($datos) {
 * $sheet->row(1, array('NOMBRE', 'APELLIDOS', 'EMAIL')); //En la fila una ponemos los nombres de las cabeceras
 * $sheet->cells('A1:C1', function ($cells) { //Rango de las celdas que vamos a modificar
 * $cells->setBackground('#ff5733'); //Setea el color de fondo de las celdas A1:C1
 * $cells->setAlignment('center'); //Alineación del texto de las celdas A1:C1
 * });
 * for ($i = 0; $i < count($datos); $i++) {
 * $sheet->row($i + 2, (array($datos[$i]->NOMBRE, $datos[$i]->APELLIDOS, $datos[$i]->EMAIL)));
 * }
 * $sheet->setBorder('A1:C10', 'thin');
 * });
 */
