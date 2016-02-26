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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#fecha").datepicker();
        });
    </script>
    <script type="text/javascript" language="javascript">
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $(function () {
            $("#fecha").datepicker();
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-7" style="margin-left: 20%; margin-top: 2%;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        Bienvenido, <?php echo Session::get('usuario');?>.</h3>
                </div>
                <div class="panel-body">
                    <div class="nav nav-pills">
                        <li role="presentation" title="Inicio">{{ HTML::link('/validado', 'Inicio') }}</li>
                        <li role="presentation" title="Alta de empresas">{{ HTML::link('/altaempresas', 'Alta empresas') }}</li>
                        <li role="presentation" title="Modificacion de empresas">{{ HTML::link('/modempresas', 'Modificar empresas') }}</li>
                        <li role="presentation" class="active" title="Desconectar">{{ HTML::link('/', 'Desconectar') }}</li>
                    </div>
                    <hr>
                    <ol class="breadcrumb">
                        <li>{{ HTML::link('/', 'Inicio') }}</li>
                        <li class="active">Modificacion de empresas</li>
                    </ol>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">Modificar empresas:</h4>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('action' => 'FCT/Admin/otros@modempresas')) !!}
                            <center>{!! Form::submit('Crear empresa',array('class'=>'btn btn-success', 'title'=>'Crear empresa')) !!}</center>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
