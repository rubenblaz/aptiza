@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
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
        span{
            font-weight: bold;
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
                    @if(Session::get('USUARIO')->hasRol(6))
                        {!! Form::open(array('action' => 'fct\encuestas@encuestas')) !!}
                    @else
                        {!! Form::open(array('action' => 'fct\encuestas@encuestas_empresas')) !!}
                    @endif
                
                    @if(Session::get('USUARIO')->hasRol(6))
                        <center><h4>CUESTIONARIO SOBRE FCT ALUMNADO</h4></center>
                    @else
                        <center><h4>CUESTIONARIO SOBRE FCT EMPRESA</h4></center>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-md-6" style="text-align: center;">
                            <span>Ciclo formativo</span><br>
                            @if(Session::get('USUARIO')->hasRol(6))
                                {!! Session::get('nombre_curso') !!}
                            @else
                                {!! Session::get('curso_empresa') !!}
                            @endif
                        </div>
                        <div class="col-md-6" style="text-align: center;">
                            <span>Empresa</span><br>
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
                            <tr>
                            <th>Preguntas</th>
                            <th>Valoración</th>
                            </tr>
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
                                    Incluye aquel/aquellos aspectos que desees destacar como <span>Positivos</span> o en
                                    su
                                    caso
                                    aquel/aquellos
                                    que deberían <span>mejorarse</span>.
                                </td>
                            </tr>
                            <tr>
                                <td id="textarea1" title="Aspectos de positivos">
                                    <span>Aspectos
                                        positivos:</span>{!! Form::textarea('observaciones1', null, ['class'=>'form-control', 'required'])!!}
                                </td>
                                <td title="Aspectos de mejora">
                                    <span>Aspectos de
                                        mejora:</span>{!! Form::textarea('observaciones2', null, ['class'=>'form-control', 'required'])!!}
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
@endsection
