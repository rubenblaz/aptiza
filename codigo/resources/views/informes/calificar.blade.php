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
<li>{!!Html::link('informes/elegirGrupo','Elegir Alumnos')!!}</li>
<li>Calificar</li>
@stop

@section('titulo')
Calificar alumnos
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
                <a href="{{url('/informes/calificarAlumno/ant')}}" class="btn btn-primary col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @else
                 <a href="" class="btn btn-primary disabled col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @endif
            @if(!Session::get('PAGINACION')->esUltimo())
                <a href="{{url('/informes/calificarAlumno/sig')}}" class="btn btn-primary pull-right col-xs-2"><span class="siguiente"></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
            @else           
                <a href="" class="btn disabled pull-right btn-primary col-xs-2"><span class="siguiente"></span><span class="glyphicon glyphicon-chevron-right"></span></a>    
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
        @foreach($modeloinforme as $seccion)
            @if($seccion->COD == 1)
                <div class="apartado col-lg-6">    
                    <h1>{{$seccion->NOMBRE}}</h1>
                    <select name="{{$seccion->APARTADOS[0]->COD}}" class='form-control' id="">
                        @foreach($seccion->APARTADOS[0]->VALORES as $valor)
                            <option value="{{$valor->COD}}">{{$valor->NOMBRE}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if($seccion->COD == 2)
                <div class="apartado col-lg-6">
                    <h1>{{$seccion->NOMBRE}}</h1>
                    <select name="{{$seccion->APARTADOS[0]->COD}}" class='form-control' id="">
                        @foreach($seccion->APARTADOS[0]->VALORES as $valor)
                                <option value="{{$valor->COD}}">{{$valor->NOMBRE}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if($seccion->COD == 3)
                <div class="apartado col-lg-6">
                    <h1>{{$seccion->NOMBRE}}</h1>
                    @foreach($seccion->APARTADOS[0]->VALORES as $valor)
                            <div class="form-group">
                                <label for="{{$valor->COD}}" text="{{$valor->NOMBRE}}">
                                    <input type="checkbox" name="{{$seccion->APARTADOS[0]->COD}}[]" id="{{$valor->COD}}" value="{{$valor->COD}}">
                                    <span> {{$valor->NOMBRE}}</span>
                                </label>
                            </div>
                    @endforeach
                </div>
            @endif
            @if($seccion->COD == 4)
                <div class="apartado col-lg-6">  
                <h1>{{$seccion->NOMBRE}}</h1>
                @foreach($seccion->APARTADOS as $apartado)
                    <p class="apartado-radio">{{$apartado->NOMBRE}}<p>
                    <div class="radio radio-inline">
                        @foreach($apartado->VALORES as $key => $valor)<!--Primera opción por defecto-->
                            <label><input type="radio" <?php echo($key==0)?'checked':'';?> name="{{$apartado->COD}}" value="{{$valor->COD}}"/>{{$valor->NOMBRE}}</label>
                        @endforeach    
                    </div>                    
                @endforeach
            @endif
        @endforeach
        </div>
        <div class="botonera-bottom col-xs-12">            
            @if(!Session::get('PAGINACION')->esPrimero())
                <a href="{{url('/informes/calificarAlumno/ant')}}" class="btn btn-primary col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @else
                 <a href="" class="btn btn-primary disabled  col-xs-2"><span class="glyphicon glyphicon-chevron-left"></span><span class="anterior"></span></a>
            @endif

            {!!Form::submit('Confirmar',['class' => 'btn btn-primary col-sm-4 col-sm-offset-2 col-xs-offset-2 col-xs-4'])!!}

            @if(!Session::get('PAGINACION')->esUltimo())
                <a href="{{url('/informes/calificarAlumno/sig')}}" class="btn btn-primary pull-right col-xs-2"><span class="siguiente"></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
            @else           
                <a href="" class="btn disabled pull-right btn-primary col-xs-2"><span class="siguiente"></span><span class="glyphicon glyphicon-chevron-right"></span></a>    
            @endif
            <div class="clearfix"></div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
@stop
@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.alert').hide().slideDown();
            
            $(".alert").fadeTo(2500, 500).slideUp(500, function () {
                $(".alert").alert('close');
            });
        });
    </script>           
@stop