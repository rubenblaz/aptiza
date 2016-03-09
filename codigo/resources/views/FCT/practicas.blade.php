<@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style type="text/css">
        body {
            background-color: #269abc;
        }
        .centrado{
            text-align: center;
        }
        .negrita{
            font-weight:bold;
        }
        .centrarinput{
            margin-left: 45%;
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
    <div class="col-md-12" style="margin-left: auto; margin-top: auto;">
        <br>
        {!! Form::open(array('action' => 'FCT\usuarios@practicas_elegir')) !!}
        <div class="row">
            @if(Session::has('operacion'))
                @if(Session::get('operacion') == "ok")
                    <div class="alert alert-success alert-dismissable fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Empresa asignada correctamente.
                    </div>
                @endif
            @endif
        </div>
        <div class="row">
            <div id="botonayuda" class="col-md-6" title="Ayuda">
                <a href="#top" title="Ayuda"><img src="img/FCT/ayuda.png" style="width: 6%; margin-left: 3%;"
                                                  alt="Ayuda"/></a>
            </div>
            <div id="ayuda" class="col-md-6" style="display:none;">
                <ul>
                    <li>Seleccionar la empresa en la lista superior.</li>
                    <li>Con una empresa seleccionada, marcar las casillas <span class="glyphicon glyphicon-check" title="Casilla de verificación"></span> de
                        los alumnos que queramos asignar a esa
                        empresa.
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <br>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="form-group">
                        <center>{!! Form::label('empresas', 'Empresas favoritas') !!}</center><br> <!-- No se puede centrar esta etiqueta únicamente con CSS. -->
                        <hr>
                        {!! Form::select('empresas', $empresas, null, array('class'=>'form-control centrado','style'=>'')) !!}
                </div>
                <div class="form-group">
                    <center>{!! Form::label('alumnos', 'Mis alumnos') !!}</center> <!-- Problema al centrar con solo CSS -->
                    <hr>
                    <div class="row">
                        <div class="col-md-3 negrita" title="Nombre">
                            Nombre
                        </div>
                        <div class="col-md-3 negrita" title="Apellidos">
                            Apellidos
                        </div>
                        <div class="col-md-3 negrita" title="Empresa actual">
                            Empresa actual
                        </div>
                        <div class="col-md-3 negrita" title="Seleccion">
                            Seleccion
                        </div>
                    </div>
                    @foreach ($alumnos as $al)
                        <div class="row">
                            <div class="col-md-3" title="Nombre">{{ $al->NOMBRE }}</div>
                            <div class="col-md-3" title="Apellidos">{{ $al->APELLIDOS }}</div>
                            {{--<td>{{ $al->CURSO }}</td>--}}
                            <div class="col-md-3" title="Empresa actual">{{ $al->NOMBRE_E }}</div>
                            <div class="col-md-3"
                                 title="Seleccion">{{ Form::checkbox('seleccionado[]',$al->N_EXP,false) }}</div>
                        </div>
                    @endforeach
                </div>
                {!! $alumnos->render() !!}
                {!! Form::submit('Asignar', array('class'=>'btn btn-success centrarinput', 'id'=>'asignar')) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('scripts')
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function () {
            $("#botonayuda").on("click", function () {
                $("#ayuda").toggle("fast");
            });
        });
    </script>
@endsection