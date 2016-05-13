@extends('layouts.plantilla')
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
    <li class="active">Selección de alumnos/as que van a FCT</li>
@stop
@section('titulo')
    Habilitación para ejercer las FCT
@stop
@section('contenido')
    <div class="col-md-12" style="margin-left: auto; margin-top: auto;">
        <br>
        {!! Form::open(array('action' => 'fct\usuarios@practicas_admitir_submit')) !!}
        <div class="row">
            @if(Session::has('operacion'))
                @if(Session::get('operacion') == "ok")
                    <div class="alert alert-success alert-dismissable fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Operación realizada correctamente.
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
                    <li>Seleccionar uno o varios alumnos que irán al periodo de prácticas.</li>
                    <li>Una vez habilitados para las prácticas, se podrá acceder a {{ HTML::link('/practicas', 'la ventana de asignación de empresas a alumnos.')}}
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <br>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('alumnos', 'Mis alumnos', ['style'=>'display: block; text-align: center;']) !!}
                    <hr>
                    <div class="row">
                        <div class="col-md-4 negrita" title="Nombre">
                            Nombre
                        </div>
                        <div class="col-md-4 negrita" title="Apellidos">
                            Apellidos
                        </div>
                        <div class="col-md-4 negrita" title="Seleccion">
                            Seleccion
                        </div>
                    </div>
                    @foreach ($alumnos as $al)
                        <div class="row">
                            <div class="col-md-4" title="Nombre">{{ $al->NOMBRE }}</div>
                            <div class="col-md-4" title="Apellidos" for="{!! $al->APELLIDOS !!}">{{ $al->APELLIDOS }}</div>
                            <div class="col-md-4"
                                 title="Seleccion">{{ Form::checkbox('seleccionado[]',$al->COD,false, ['id'=>$al->APELLIDOS]) }}</div>
                        </div>
                    @endforeach
                </div>
                {!! $alumnos->render() !!}
                {!! Form::submit('Apto', array('class'=>'btn btn-success centrarinput', 'id'=>'asignar')) !!}
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