@extends('layouts.plantilla')

@section('customcss')
<style type="text/css">
    .apartado{
        margin-top:10px;
        padding: 10px;
    }
    .apartado h1{
        color:white;
        background: #08c;
        font-size: 1.5em;
        margin-bottom: 20px;
        padding: 5px;
    }
    .formulario{
        padding: 0px 20px 20px 20px;
    }
    .botonera-top{
        padding-bottom: 15px;
        margin-bottom: 30px;
        border-bottom: 1px solid #08c;
    }
    .botonera-bottom{
        padding-top: 30px;
        margin-top: 20px;
        border-top: 1px solid #08c;
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
    .siguiente:after{
        content: 'Siguiente';
    }
    .anterior:before{
        content:'Anterior';
    }
    .label-primary{
        margin-left:80px !important;
    }
    @media (max-width: 700px) {
        .siguiente:after{
            content:'';
        }
        .anterior:before{
            content:'';
        }
        .form-group{
        margin-bottom: 5px !important;
    }
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
    @if (session('mensaje'))
        <div class="alert alert-success">
            <p>{{ session('mensaje') }}<b>{{$nombre}}</b>.</p>
        </div>
    @endif
        <div class="botonera-top col-xs-12">            
            @if(!Session::get('PAGINACION')->esPrimero())
                <a href="{{url('/informes/calificarAlumno/ant')}}" class="btn btn-primary col-sm-2 col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @else
                 <a href="" class="btn btn-primary disabled col-md-2 col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @endif
            @if(!Session::get('PAGINACION')->esUltimo())
                <a href="{{url('/informes/calificarAlumno/sig')}}" class="btn btn-primary pull-right col-sm-2 col-xs-2"><span class="siguiente"></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
            @else           
                <a href="" class="btn disabled pull-right btn-primary col-sm-2 col-xs-2"><span class="siguiente"></span><span class="glyphicon glyphicon-chevron-right"></span></a>    
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <h2>{{Session::get('PAGINACION')->getAsignatura_nombre()}}</h2>
                <h1>{{$nombre}}</h1>
            </div>
            <div class="col-sm-4">
                <h3 class="pull-right">Evaluación <br><span class="label label-primary">{{Session::get('PAGINACION')->getEvaluacion()}}</span><br></h3>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-1 formulario">
        
        {!! Form::open(['url'=>'/informes/crearInforme', 'method' => 'POST']) !!}
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
                @endif
            @endforeach
        @endforeach
        </div>
        <div class="botonera-bottom col-xs-12">            
            @if(!Session::get('PAGINACION')->esPrimero())
                <a href="{{url('/informes/calificarAlumno/ant')}}" class="btn btn-primary col-sm-2 col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @else
                 <a href="" class="btn btn-primary disabled col-md-2 col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @endif

            {!!Form::submit('Confirmar',['class' => 'btn btn-primary col-sm-4 col-sm-offset-2 col-xs-offset-2 col-xs-4'])!!}

            @if(!Session::get('PAGINACION')->esUltimo())
                <a href="{{url('/informes/calificarAlumno/sig')}}" class="btn btn-primary pull-right col-sm-2 col-xs-2"><span class="siguiente"></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
            @else           
                <a href="" class="btn disabled pull-right btn-primary col-sm-2 col-xs-2"><span class="siguiente"></span><span class="glyphicon glyphicon-chevron-right"></span></a>    
            @endif
            <div class="clearfix"></div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@stop
@section('scripts')
@stop