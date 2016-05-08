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
Elegir Alumnos
@stop
@section('contenido')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1>{{$grupo}}</h1>
        <h3>Evaluacion</h3>
            @foreach($evaluaciones as $evaluacion)
                <div class="btn-group" role="group" arial-label="...">
                    {{link_to_route('informes/generarInforme',$evaluacion,['evaluacion'=>$evaluacion],['class'=>'btn '.(($evaluacion == $actualeval)? 'btn-danger':'btn-primary'),'role'=>'button'])}}
                </div>
            @endforeach
        <h3>Alumnos</h3>
        @foreach($alumnos as $alumno)
            <p>{{link_to_route('informes/generarPDF','PDF',[$alumno->getCod(),$actualeval],['class'=>'btn btn-sm '.(($calificacion->esCompleta($alumno->getCod()))? 'btn-success':'btn-danger'),'role'=>'button'])}}&nbsp;&nbsp;&nbsp;{{$alumno->getNombreByCod($alumno->getCod())}}</p>
        @endforeach
    </div>
    @stop
    @section('scripts')
    <script>
       
    </script>
    @stop
