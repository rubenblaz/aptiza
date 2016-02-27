@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
    <style type="text/css"> body {
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
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Encuestas</li>
@stop
@section('titulo')
    Encuestas
@stop
@section('contenido')
    <div class="row">
        <div class="col-md-12" style="margin-left: auto; margin-top: auto; width: auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(array('action' => 'FCT\encuestas@encuestas')) !!}
                    @if(Session::get('USUARIO')->hasRol(6))
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
                            @if(Session::get('USUARIO')->hasRol(6))
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
                            @if(Session::get('USUARIO')->hasRol(6))
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
                            <th>Encuesta</th>
                            {!! $aux = 0 !!}
                            @foreach($encuestas as $enc)
                                <th>{!! $aux !!}</th>
                                {!! $aux++ !!}
                            @endforeach
                            <th>Media</th>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
