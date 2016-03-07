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
    public function index()
    {

        $aux = "prueba";

        Excel::create('Memoria Excel', function ($excel) use ($aux){
            $excel->sheet('Memoria', function ($sheet) use ($aux){
                $sheet->with(array($aux, "holaaaa"));
            });
        })->export('xls');
    }
}
