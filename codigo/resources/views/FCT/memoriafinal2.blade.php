@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style type="text/css">
        table {
            margin-top: 1.5%;
        }

        span {
            display: none;
        }

        .fechas {
            font-size: smaller;
        }

        .table-responsive {
            font-size: 0.8em;
        }

        .inputs {
            font-size: 1em !important;
        }

        textarea {
            resize: none;
        }

        input[type="checkbox"] {

        }

        .centrarinput{
            margin-left: 45%;
        }

        #submitpdf{
            margin-left: 40%;
        }
        .negrita {
            font-weight: bold;
            display: inline-flex;
        }

    </style>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Memoria final - Excel</li>
@stop
@section('titulo')
    Memoria final - Excel
@stop
@section('contenido')
    {!! Form::open(array('action' => 'ExcelController@index', 'id'=>'formulario')) !!}
    <div class="row">
        <div class="col-md-12">
            <p>
                <span class="negrita"
                      title="Tutor"> Tutor: </span> {!! Form::text('nombre_tutor', Session::get('nombre_tutor') . ", " . Session::get('apellidos_tutor'), array('class'=>'form-control','title'=>'Nombre y apellidos de tutor')) !!}
            </p>
            <p>
                <span class="negrita"
                      title="Grupo">Grupo: </span> {!! Form::text('nombre_grupo', Session::get('nombre_grupo'),array('class'=>'form-control','title'=>'Nombre del grupo')) !!}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="from-group">
            <div class="col-md-12">
                {!! Form::label('Curso académico: ') !!}
                {!! Form::text('curso_academico', "2016/2017", array('placeholder'=>'2016/2017', 'class'=>'form-control', 'required', 'title'=>'Curso académico')) !!}
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
            <th>Nº</th>
            <th>Alumno</th>
            <th>Empresa</th>
            <th>Nº Convenio</th>
            <th>Tfno móvil</th>
            <th>Tfno fijo</th>
            <th>E-mail</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>¿Apto?</th>
            <hr>
            </thead>
            <tbody>
            <span>{!! $cont = 0 !!}</span>
            @foreach($mis_alumnos as $al)
                <tr>
                    <td>
                        {!! $cont !!}
                    </td>
                    <td>
                        {!! Form::textarea('nombre_apellidos[]', $al->APELLIDOS . ", " . $al->NOMBRE, array('class'=>'form-control inputs', 'rows'=>'4', 'title'=>'Nombre y apellidos')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('nombre_e[]', $al->NOMBRE_E ,array('class'=>'form-control inputs', 'rows'=>'4', 'title'=>'Nombre empresa')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('convenio[]', $al->CONVENIO ,array('class'=>'form-control inputs', 'rows'=>'4', 'title'=>'Convenio')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('telefono_m[]', $al->TELEFONO_M ,array('class'=>'form-control inputs','rows'=>'4', 'title'=>'Telefono movil')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('telefono_f[]', $al->TELEFONO_F ,array('class'=>'form-control inputs', 'rows'=>'4','title'=>'Telefono fijo')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('email[]', $al->EMAIL ,array('class'=>'form-control inputs','rows'=>'4', 'title'=>'Email')) !!}
                    </td>
                    <td>
                        {!! Form::date('fecha_inicio[]', \Carbon\Carbon::now(), array('class'=>'form-control fechas', 'title'=>'Fecha de inicio')) !!}
                    </td>
                    <td>
                        {!! Form::date('fecha_fin[]', \Carbon\Carbon::now(), array('class'=>'form-control fechas', 'title'=>'Fecha de fin')) !!}
                    </td>
                    <td>
                        {!! Form::select('aptos[]', array('SI' => 'SI', 'NO' => 'NO'), 'SI', array('class'=>'form-control')) !!}
                        {{--{!! Form::text('aptos[]', "S", ['title'=>'¿Apto o no apto?', 'class'=>'form-control inputs']) !!}--}}
                    </td>
                </tr>
                <span>{!! $cont++ !!}</span>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {!! Form::submit('Generar Excel', array('class'=>'btn btn-success centrarinput', 'title'=>'Generar Excel')) !!}
    {!! Form::close() !!}
@stop
@section('scripts')
    <script type="text/javascript" language="JavaScript">
        /*$(document).ready(function () {
            $("input[type=submit]").click(function () {
                var accion = $(this).attr('dir');
                $('form').attr('action', accion);
                $('form').submit();
            });
        });*/
    </script>

@stop