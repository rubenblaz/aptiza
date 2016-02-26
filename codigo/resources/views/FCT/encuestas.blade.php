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
        /*$(document).ready(function () {
         $("#hola").fadeOut('slow')
         });*/
    </script>
    <style type="text/css">
        body {
            background-color: #269abc;
        }

        .infoextra {
            display: inline-flex;
            margin-left: 7.5%;
            padding: 1%;
            text-align: center;
        }

        #contenedorinfo {

        }

        textarea {
            resize: none;
        }

        #textarea1 {
            width: 50%;
        }

        #info2 {
            text-align: center;
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
                        <li role="presentation" title="Encuestas">{{ HTML::link('/encuestas', 'Encuestas') }}</li>
                        <li role="presentation" title="Administrar mi cuenta">{{ HTML::link('/admincuenta', 'Mi cuenta') }}</li>
                        <li role="presentation" class="active" title="Desconectar">{{ HTML::link('/', 'Desconectar') }}</li>
                    </div>
                    <hr>
                    <ol class="breadcrumb">
                        <li>{{ HTML::link('/', 'Inicio') }}</li>
                        <li class="active">Encuestas</li>
                    </ol>
                    <br>
                    {!! Form::open(array('action' => 'FCT/encuestas@encuestas')) !!}
                    @if(Session::get('rol') == 6)
                        <center><h4>CUESTIONARIO SOBRE FCT ALUMNADO</h4></center>
                    @else
                        <center><h4>CUESTIONARIO SOBRE FCT EMPRESA</h4></center>
                    @endif
                    <hr>
                    <div id="contenedorinfo">
                        <div class="infoextra" id="hola">
                            Curso escolar<br>
                        </div>
                        <div class="infoextra">
                            Ciclo formativo<br>
                            @if(Session::get('rol') == 6)
                                {!! Session::get('nombre_curso') !!}
                            @else
                                {!! Session::get('curso_empresa') !!}
                            @endif
                        </div>
                        <div class="infoextra">
                            Periodo de realización<br>
                        </div>
                        <div class="infoextra">
                            Empresa<br>
                            @if(Session::get('rol') == 6)
                                {!! Session::get('nombre_empresa') !!}
                            @else
                                {!! Session::get('mi_nombre') !!}
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <th>Preguntas</th>
                            <th>Valoración</th>
                            </thead>
                            <tbody>
                            @foreach($preguntas as $preg)
                                <tr>
                                    <td>{!! $preg->TEXTO !!}</td>
                                    <td>{!! Form::select('opciones[]', $opciones, null , array('class'=>'form-control')) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tr>
                                <td colspan="2" id="info2">
                                    Incluye aquel/aquellos aspectos que desees destacar como <b>Positivos</b> o en su
                                    caso
                                    aquel/aquellos
                                    que deberían <b>mejorarse</b>.
                                </td>
                            </tr>
                            <tr>
                                <td id="textarea1" title="Aspectos de positivos">
                                    <b>Aspectos
                                        positivos:</b>{!! Form::textarea('observaciones1', null, ['class'=>'form-control', 'required'])!!}
                                </td>
                                <td title="Aspectos de mejora">
                                    <b>Aspectos de
                                        mejora:</b>{!! Form::textarea('observaciones2', null, ['class'=>'form-control', 'required'])!!}
                                </td>
                            </tr>
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
