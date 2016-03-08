@extends('layouts.plantilla')
@section('customcss')
    <style type="text/css">
        .principal{
            margin: 1%;
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
        @foreach($todas_empresas as $emp)
            <div class="col-md-10 well">
                {!! $emp->NOMBRE !!}
            </div>
            <div class="col-md-2">
                <a href="{{URL::to('/modempresas2', $emp->CIF)}}"
                   title="Modificar empresa">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
            </div>
        @endforeach
        {!! $todas_empresas->render() !!}
    </div>
@stop
@section('scripts')
@stop