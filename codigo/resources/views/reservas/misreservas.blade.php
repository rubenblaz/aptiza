@extends('layouts.plantilla')

@section('customcss')
<style type="text/css">
    #horas li{
        list-style: none;
        border-bottom: solid 1px lightgray;
    }
    ul{
        padding-left: 20px;
        list-style: none;
    }
    #reservaseditar{
        margin-right:10px;
    }
    #reservatitulo{
        margin-left:10px;
    }
</style>
@endsection

@section('migas')
<li>{!!Html::link('inicio','Inicio')!!}</li>
<li class="active">Mis Reservas</li>
@stop
@section('titulo')
Mis reservas
@stop
@section('contenido')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <ul>
            @if(count($misreservas) == 0)
            <p class='text-center'>No tiene reservas activas</p>
            @else
            @foreach($misreservas as $reserva)
            <li id="reserva" class="row">
                <ol class="col-md-12 col-sm-12 list-group">
                    <li class="list-group-item active">
                        <div class="row">
                            <div id='reservatitulo' class="pull-left">
                                <p class="">{{$reserva->getFecha()}} - {{$reserva->getAula()}}</p>
                            </div>    
                            <div id='reservaseditar' class="pull-right">
                                <a  class='btn btn-default btn-sm glyphicon glyphicon-trash' tittle='eliminar' href="{{route('delreserva',['fecha' => $reserva->getFecha(),'aula' => $reserva->getAula()])}}"><span class='src_only' style='display:none'>>Eliminar</span></a>
                                <a  class='btn btn-default btn-sm glyphicon glyphicon-pencil' tittle='modificar' href="{{route('toreservas',['fecha' => $reserva->getFecha(),'aula' => $reserva->getAula()])}}"><span class='src_only' style='display:none'>Editar</span></a>
                            </div>
                        </div>
                    </li>
                    @foreach($reserva->getHoras() as $hora)
                    <li class="list-group-item">
                       <!-- <span>{!!$hora->getNumhora()!!}</span>-->
                        <span>{!!$hora->getHora()!!}</span>
                        <span>{{$reserva->getAula()}}</span>
                    </li>
                    @endforeach
                </ol>
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>
@stop
