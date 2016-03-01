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
        .fechas{

        }
    </style>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Memoria final</li>
@stop
@section('titulo')
    Memoria final
@stop
@section('contenido')
    {!! Form::open(array('action' => 'FCT\usuarios@generar_excel')) !!}
    <div class="row">
        <div class="col-md-12">
            <p><b>Tutor: </b> {!! Session::get('nombre_tutor') . " " . Session::get('apellidos_tutor')!!}</p>
            <p><b>Grupo: </b> {!! Session::get('nombre_grupo') !!}</p>
        </div>
    </div>
    <div class="row">
        <div class="from-group">
            <div class="col-md-2">
                {!! Form::label('Curso académico: ') !!}
            </div>
            <div class="col-md-2">
                {!! Form::text('curso_academico', null, array('placeholder'=>'2016/2017', 'class'=>'form-control', 'required', 'title'=>'Curso académico')) !!}
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
            </thead>
            <tbody>
            <span>{!! $cont = 0 !!}</span>
            @foreach($mis_alumnos as $al)
                <tr>
                    <td>
                        {!! $cont !!}
                    </td>
                    <td>
                        {!! $al->APELLIDOS . ", " . $al->NOMBRE!!}
                    </td>
                    <td>
                        {!! $al->NOMBRE_E !!}
                    </td>
                    <td>
                        {!! $al->CONVENIO !!}
                    </td>
                    <td>
                        {!! $al->TELEFONO_M !!}
                    </td>
                    <td>
                        {!! $al->TELEFONO_F !!}
                    </td>
                    <td>
                        {!! $al->EMAIL !!}
                    </td>
                    <td>
                        {!! Form::date('fecha_inicio[]', null, array('class'=>'form-control fechas')) !!}
                    </td>
                    <td>
                        {!! Form::date('fecha_fin[]', null, array('class'=>'form-control fechas')) !!}
                    </td>
                    <td>
                        {!! Form::text('apto', null, array('placeholder'=>'APTO/NO APTO', 'class'=>'form-control', 'required')) !!}
                    </td>
                </tr>
                <span>{!! $cont++ !!}</span>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <center>{!! Form::submit('Generar Excel', array('class'=>'btn btn-success')) !!}</center>
    {!! Form::close() !!}
@stop
@section('scripts')
@stop