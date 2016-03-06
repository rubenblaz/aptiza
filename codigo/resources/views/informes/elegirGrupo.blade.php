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

        {!! Form::open(['url'=>'reservar', 'method' => 'POST']) !!}
        <div class="form-group">
            {!!Form::label('grupos','Grupos', ['class' => 'control-label'])!!}
            {!! Form::select('grupo',$grupos, $grupo,['class' => 'form-control']) !!}   
        </div>
        <div class="form-group">
            <label for="asignaturas">Asignaturas</label>
            <select name='asignatura' class="form-control" id="asignaturas" multiple>
               
            </select>
        </div>
        <div class="form-group">
            <label>Alumnos</label>
        <div id='alumnos'>

        </div>
        </div>
        {!!Form::close()!!}

    </div>
    @stop
    @section('scripts')
    <script>
        $('document').ready(function(){
           
           $('select[name="grupo"]').change(consulta);
           
           consulta();
        
            function consulta(){
                $('#alumnos').html('');
                $('#asignaturas').html('');
                
                var grupo = $('select[name="grupo"]').val(); //variable para ajax;
                
                $.post("{{url('/informes/ajaxAlumnos')}}", {grupo: grupo}, function (data) {
                   
                    $.each(JSON.parse(data),function(index,value){
                        
                        if(index.indexOf('ALUMN')>=0){
                        $('#alumnos').append('<div class="checkbox"><label><input type="checkbox" value="'+ value.COD+'">'+ value.NOMBRE +' '+value.APELLIDOS+'</label></div>');
                    }else{
                        
                        $('#asignaturas').append('<option value="'+value.COD + '">'+value.NOMBRE + '</option>');
                    }
                    });
                });
            } 
        
        });
        
    </script>
    @stop
