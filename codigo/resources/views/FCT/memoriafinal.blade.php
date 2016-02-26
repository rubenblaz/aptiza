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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript">
    </script>
    <style type="text/css">
        body {
            background-color: #269abc;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin-left: 3%; margin-top: 12%; width: auto;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-user"
                                                  aria-hidden="true"></span>Bienvenido, <?php echo Session::get('usuario');?>
                        .</h3>
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
                        <li class="active">Memoria Final</li>
                    </ol>
                    <br>
                    {!! Form::open(array('action' => 'FCT/usuarios@memoriafinal')) !!}
                    <hr>
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <center>{!! Form::submit('Enviar encuesta',array('class'=>'btn btn-success', 'title'=>'Enviar encuesta')) !!}</center>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
