<@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style type="text/css">
        body {
            background-color: #269abc;
        }
    </style>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Asignación de empresas</li>
@stop
@section('titulo')
    Asignación de empresas
@stop
@section('contenido')
    <div class="col-md-7" style="margin-left: 20%; margin-top: 12%;">
        <div class="panel panel-default">
            <div class="panel-body">
                <br>
                {!! Form::open(array('action' => 'FCT/usuarios@practicas_elegir')) !!}
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Asignación de empresas a los alumnos:</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <center>
                                {!! Form::label('Empresas favoritas') !!}<br>
                                {!! Form::select('empresas', $empresas, null, array('class'=>'form-control','style'=>'')) !!}
                            </center>
                        </div>
                        <div class="form-group">
                            <center>{!! Form::label('Mis alumnos') !!}</center>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <!--<th>Curso</th>-->
                                    <th>Calificacion</th>
                                    <th>Selección</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($alumnos as $al)
                                        <tr>
                                            <td>{{ $al->NOMBRE }}</td>
                                            <td>{{ $al->APELLIDOS }}</td>
                                            {{--<td>{{ $al->CURSO }}</td>--}}
                                            <td>{{ $al->CALIFICACION }}</td>
                                            <td>{{ Form::checkbox('seleccionado[]',$al->N_EXP,false) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <center>{!! Form::submit('Asignar', array('class'=>'btn btn-success', 'id'=>'asignar')) !!}</center>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
