@extends('layouts.plantilla')

@section('customcss')
<style type="text/css">
    .apartado{
        margin-top:10px;
        padding: 10px;
    }
    .apartado h1{
        font-size: 1.5em;
        margin-bottom: 20px;
        border-bottom: 1px solid blue;
    }
    .formulario{
        padding: 20px;
    }
    .botonera{
        margin-top:20px;
    }
    .apartado-radio{
        font-weight: 900;
        margin-top:0px;
        margin-bottom: 0px;
    }
    .radio-inline{
        margin-top: 0px !important;
        margin-bottom: 5px !important;
    }
    .form-group{
        margin-bottom: 27px !important;
    }
   
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
<div class="row ">
    <div class="col-md-10 col-md-offset-1">
        <h2>{{Session::get('PAGINACION')->getAsignatura_nombre()}}</h2>
        <h3 class="pull-right">Evaluacion<span class="label label-primary">{{Session::get('PAGINACION')->getEvaluacion()}}</span></h3>
        <h1>{{$nombre}}</h1>
    </div>
    <div class="col-md-10 col-md-offset-1 formulario">
    {!! Form::open(['url'=>'/informes/generarInforme', 'method' => 'POST']) !!}
    @foreach($secciones as $key=>$seccion)
        @foreach($apartados as $apartado)
            @if($seccion->COD == 1 && $apartado->SECCION == $seccion->COD)  
                <div class="apartado col-lg-6">    
                <h1>{{$seccion->NOMBRE}}</h1>
                <select name="{{$apartado->COD}}" class='form-control' id="">
                    @foreach($valores as $valor)
                        @if($valor->APARTADO == $seccion->COD)
                        <option value="{{$valor->COD}}">{{$valor->NOMBRE}}</option>
                        @endif
                    @endforeach
                </select>
                </div>
            @endif
            @if($seccion->COD == 2 && $apartado->SECCION == $seccion->COD)
                <div class="apartado col-lg-6">
                <h1>{{$seccion->NOMBRE}}</h1>
                <select name="{{$apartado->COD}}" class='form-control' id="">
                    @foreach($valores as $valor)
                        @if($valor->APARTADO == $seccion->COD)
                            <option value="{{$valor->COD}}">{{$valor->NOMBRE}}</option>
                        @endif
                    @endforeach
                </select>
                </div>
            @endif
            @if($seccion->COD == 3 && $apartado->SECCION == $seccion->COD)
                <div class="apartado col-lg-6">
                <h1>{{$seccion->NOMBRE}}</h1>
                @foreach($valores as $valor)
                    @if($valor->APARTADO == $seccion->COD)
                        <div class="form-group">
                            <input type="checkbox" name="{{$apartado->COD}}[]" id="{{$valor->COD}}" value="{{$valor->COD}}">
                            <label for="{{$valor->COD}}" text="{{$valor->NOMBRE}}">{{$valor->NOMBRE}}</label>
                        </div>
                    @endif
                @endforeach
                </div>
            @endif
            @if($seccion->COD == 4 && $apartado->SECCION == $seccion->COD)
                @if($key == 3)
                    <div class="apartado col-lg-6">  
                    <h1>{{$seccion->NOMBRE}}</h1>
                @endif
                <p class="apartado-radio">{{$apartado->NOMBRE}}<p>
                <div class="radio radio-inline">
                @foreach($valores as $key => $valor)
                    @if($valor->APARTADO == $seccion->COD)
                        @if(($key+1) === 17)
                            <label><input type="radio" checked="checked" name="{{$apartado->COD}}" selected="true" value="{{$valor->COD}}"/>{{$valor->NOMBRE}}</label>
                        @else
                            <label><input type="radio" name="{{$apartado->COD}}" value="{{$valor->COD}}"/>{{$valor->NOMBRE}}</label>
                        @endif
                    @endif
                @endforeach    
                </div>
                <br>
            @endif
        @endforeach
    @endforeach
    </div>
    <div class="botonera">            
        {!!Form::submit('Aceptar',['class' => 'btn btn-primary col-xs-12'])!!}
        {!!Form::close()!!}
        @if(!Session::get('PAGINACION')->esPrimero())
            {{Html::link('/informes/calificarAlumno/ant','Anterior',['class'=>'btn btn-primary col-xs-6'])}}
        @else
        <div class="btn btn-primary disabled col-xs-6">
            <span>Anterior</span>
        </div>
        @endif

        @if(!Session::get('PAGINACION')->esUltimo())
            {{Html::link('/informes/calificarAlumno/sig','Siguiente<span class="glyphicon glyphicon-print"></span>',['class'=>'btn btn-primary col-xs-6'])}}
            <a href="{{url('/informes/calificarAlumno/sig')}}" class="btn btn-primary col-xs-6">Sigente <span class="glyphicon glyphicon-chevron-right"></span></a>
            @else
            <div class="btn btn-primary disabled col-xs-6">
            <span>Siguiente</span>
            </div>
        @endif
        </div>
    </div>
</div>
@stop
@section('scripts')
@stop