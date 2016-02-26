<?php namespace Collective\Html;
use Html;
use Session;
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
        <div class="col-md-6" style="margin-left: 20%; margin-top: 12%;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-user"
                                                  aria-hidden="true"></span>Bienvenido, <?php echo Session::get('usuario');?>
                        .</h3>
                </div>
                <div class="panel-body">
                    <div class="nav nav-pills">
                        <li role="presentation" title="Encuestas">{{ HTML::link('/encuestas', 'Encuestas') }}</li>
                        <li role="presentation" title="Administrar mi cuenta">{{ HTML::link('/admincuenta', 'Administrar mi cuenta') }}</li>
                        <li role="presentation"
                            class="active" title="Desconectar">{{ HTML::link('/', 'Desconectar') }}</li>
                    </div>
                    <hr>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
