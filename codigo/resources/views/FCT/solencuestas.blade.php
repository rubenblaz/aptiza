@extends('layouts.plantilla')
@section('customcss')
    <style type="text/css">
        p {
            text-align: center;
        }
    </style>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Solicitar encuestas</li>
@stop
@section('titulo')
    Solicitud de encuestas
@stop
@section('contenido')
    <div class="row" style="padding: 2%;">
        <p>
        <h3>Empresas disponibles</h3></p><br>
        @foreach($empresas as $emp)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="display: inline;">
                            <p title="Nombre empresa"><span class="nombresempresas">{!! $emp->NOMBRE !!}</span></p>
                            <p title="Icono enviar correo"><span class="label label-info" class="iconoemail"><a
                                            href="{{URL::to('/enviardatos', $emp->CIF)}}"
                                            title="Enviar credenciales">
                                        <i class="glyphicon glyphicon-envelope" style="width: 15%; color: white;"></i>
                                    </a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {!! $empresas->render() !!}
@stop
@section('scripts')
@stop