@extends('layouts.plantilla')
@section('customcss')
    <style type="text/css">
        .principal{
            margin: 1%;
        }
        p{
            font-size: x-large;
        }
    </style>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Modificación empresas</li>
@stop
@section('titulo')
    Modificación de empresas
@stop
@section('contenido')
    <div class="row principal">
        <p title="Lista de empresas disponibles">Lista de empresas:</p>
        @foreach($todas_empresas as $emp)
            <div class="col-md-10 well" title="Nombre">
                {!! $emp->NOMBRE !!}
            </div>
            <div class="col-md-2 well" title="Editar empresas">
                <a href="{{URL::to('/modempresas2', $emp->CIF)}}"
                   title="Modificar empresa">Modificar
                    <span class="glyphicon glyphicon-pencil" title="Editar empresa {!! $emp->CIF !!}"></span>
                </a>
            </div>
        @endforeach
        {!! $todas_empresas->render() !!}
    </div>
@stop
@section('scripts')
@stop