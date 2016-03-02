@extends('layouts.plantilla')

@section('migas')
    <li class="active">Inicio</li>
@stop
@section('titulo')
    Cambiar contraseña
@stop

@section('contenido')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                    {!! Form::open(array('action'=>'admin\UsuarioController@cambiarPassword','role'=>'form')) !!}
                {!! Form::hidden('email',$email) !!}
                    <div class="form-group">
                        {!! Form::label('password','Contraseña') !!}
                        {!! Form::password('password',array('class'=>'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_repeat','Repite contraseña') !!}
                        {!! Form::password('password_repeat',array('class'=>'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Guardar cambios',['class'=>'btn  btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
            @if (count($errors)>0)
                <div class="alert alert-danger alert-dismissable fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->all() as $error)

                        {!! $error !!}
                    @endforeach
                </div>
            @endif


        </div>
    </div>


@endsection