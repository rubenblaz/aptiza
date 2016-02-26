<?php namespace Collective\Html;
use Html;
use Session;
use Form;
use URL;
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de entrada.</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <style type="text/css">
        body {
            background-color: #269abc;
        }
    </style>
    <script src="jquery-1.12.0.min.js">
        $('.input_class_checkbox').each(function () {
            $(this).hide().after('<div class="class_checkbox" />');

        });

        $('.class_checkbox').on('click', function () {
            $(this).toggleClass('checked').prev().prop('checked', $(this).is('.checked'))
        });
    </script>
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
                        <li>{{ HTML::link('/', 'Inicio') }}</li>
                        <li class="active">Empresas</li>
                    </ol>
                    <br>
                    <center><b><p>Listado completo de todas las empresas disponibles:</p></b></center>
                    <br>
                    {!! Form::open(array('action' => 'FCT/usuarios@empresas_favoritas')) !!}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <th>CIF</th>
                            <th>Población</th>
                            <th>Provincia</th>
                            <th>Teléfono</th>
                            <th>Nombre</th>
                            <th>Alias</th>
                            <th>¿Favorita?</th>
                            </thead>
                            <tbody>
                            @foreach($empresas as $emp)
                                <tr>
                                    <td>{{ $emp->CIF }}</td>
                                    <td>{{ $emp->POBLACION }}</td>
                                    <td>{{ $emp->PROVINCIA }}</td>
                                    <td>{{ $emp->TELEFONO }}</td>
                                    <td>{{ $emp->NOMBRE }}</td>
                                    <td>{{ $emp->ALIAS }}</td>
                                    <td>
                                        @if($emp->FAVORITA == "SI") <!-- Preguntar a fernando que hacer en el caso de que sea favorita y en el caso de que no -->
                                        <a href="{{URL::to('/borrar', $emp->CIF)}}" title="Borrar empresa de favoritas">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                        {{--<a href="{{route('/borrar', ['CIF'=>$emp->CIF])}}">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>--}}
                                        @else
                                            {!! Form::checkbox('favoritas[]', $emp->CIF, false) !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <center>{!! Form::submit('Aceptar', array('class'=>'btn btn-success')) !!}</center>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
