@extends('layouts.plantilla')
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
    <li class="active"></li>
@stop
@section('titulo')
    Alta de empresas
@stop
@section('contenido')
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
                            <li role="presentation"
                                title="Administrar mi cuenta">{{ HTML::link('/admincuenta', 'Administrar mi cuenta') }}</li>
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
@stop