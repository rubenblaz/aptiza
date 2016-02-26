<?php namespace Collective\Html;
use Html;
use Session;
use Form;
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulario de entrada.</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <style type="text/css">
        body {
            background-color: #269abc;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-7" style="margin-left: 20%; margin-top: 12%;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Bienvenido, <?php echo Session::get('usuario');?>.</h3>
                </div>
                <div class="panel-body">
                    <div class="nav nav-pills">
                        <li role="presentation" title="Inicio">{{ HTML::link('/validado', 'Inicio') }}</li>
                        <li role="presentation" title="Consultar empresas">{{ HTML::link('/consulta', 'Consultar empresas') }}</li>
                        <li role="presentation" title="Asignar empresas">{{ HTML::link('/practicas', 'Asignar empresas') }}</li>
                        <li role="presentation" title="Solicitar encuestas">{{ HTML::link('/solencuestas', 'Solicitar encuestas') }}</li>
                        <li role="presentation" title="Memoria final">{{ HTML::link('/memoria', 'Memoria') }}</li>
                        <li role="presentation" title="Hoja de firmas de alumnos FCT">{{ HTML::link('/informe1', 'Hoja de firmas de alumnos FCT') }}</li>
                        <li role="presentation" class="active" title="Desconectar">{{ HTML::link('/', 'Desconectar') }}</li>
                    </div>
                    <hr>
                    <ol class="breadcrumb">
                        <li>{{ HTML::link('inicio', 'Inicio') }}</li>
                        <li class="active">Asignar empresas</li>
                    </ol>
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
    </div>
</div>
</body>
</html>
