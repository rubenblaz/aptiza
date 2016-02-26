<?php namespace Collective\Html;
use Html;
use Session;
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
    <style type="text/css">
        body {
            background-color: #269abc;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
                    @if(Session::has('operacion'))
                        @if(Session::get('operacion') == "ok")
                            <div class="alert alert-success alert-dismissable fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Operación realizada correctamente.
                            </div>
                        @else
                            <div class="alert alert-danger alert-dismissable fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Ha ocurrido algún error al realizar la operación.
                            </div>
                        @endif
                    @endif
                    @if(Session::has('deleteinfo'))
                        @if(Session::get('deleteinfo') == "ok")
                            <div class="alert alert-success alert-dismissable fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Operación realizada correctamente.
                            </div>
                        @else
                            <div class="alert alert-danger alert-dismissable fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Ha ocurrido algún error al realizar la operación.
                            </div>
                        @endif
                    @endif
                    @if(Session::has('empresafav'))
                        @if(Session::get('empresafav') == "ok")
                            <div class="alert alert-success alert-dismissable fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Modificado correctamente.
                            </div>
                        @else
                            <div class="alert alert-danger alert-dismissable fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Fallo al modificar.
                            </div>
                        @endif
                    @endif
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
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
