@extends('layouts.plantilla')

@section('customcss')
<style type="text/css">
</style>
@endsection

@section('migas')
<li>{!!Html::link('inicio','Inicio')!!}</li>
<li><a href="#"></a>Informes</li>
@stop
@section('titulo')
Calificar
@stop
@section('contenido')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h2>{{Session::get('PAGINACION')->getAsignatura_nombre()}}</h2>
        <h3 class="pull-right">Evaluacion<span class="label label-primary">{{Session::get('PAGINACION')->getEvaluacion()}}</span></h3>
        <h1>{{$nombre}}</h1>
        {!! Form::open(['url'=>'/informes/calificarAlumno', 'method' => 'POST']) !!}
            @foreach($secciones as $seccion)
                <p>{{$seccion->NOMBRE}}</p>
                @if($seccion->COD == 1)
                    <select name="valoracion" class='form-control' id="">
                    @foreach($valores as $valor)
                        @if($valor->APARTADO == $seccion->COD)
                            <option value="{{$valor->COD}}">{{$valor->NOMBRE}}</option>
                        @endif
                    @endforeach
                    </select>
                @endif
                @if($seccion->COD == 2)
                <select name="valoracion" class='form-control' id="">
                    @foreach($valores as $valor)
                        @if($valor->APARTADO == $seccion->COD)
                            <option value="{{$valor->COD}}">{{$valor->NOMBRE}}</option>
                        @endif
                    @endforeach
                </select>
                @endif
                @if($seccion->COD == 3)
                    @foreach($valores as $valor
                        @if($valor->APARTADO == $seccion->COD)
                        <label>
                        <input type="checkbox" name="medidas[]" value="{{$valor->COD}}">
                        @endif
                    @endforeach
                @endif
            @endforeach
            {!!Form::submit('Aceptar',['class' => 'btn btn-primary pull-right'])!!}
        {!!Form::close()!!}
    </div>
    <div class='col-md-6 col-md-offset-3'>
        <div class="pull-left">
            @if(!Session::get('PAGINACION')->esPrimero())
                {{Html::link('/informes/calificarAlumno/ant','Anterior')}}
            @else
                <p>Anterior</p>
            @endif
        </div>
        <div class="pull-right">
            @if(!Session::get('PAGINACION')->esUltimo())
                {{Html::link('/informes/calificarAlumno/sig','Siguiente')}}
            @else
                <p>Siguiente</p>
            @endif
        </div>
    </div>
</div>
@stop
@section('scripts')
@stop
