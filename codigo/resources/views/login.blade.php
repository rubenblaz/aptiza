@extends('layouts.plantilla')


@section('element-migas')
@stop
@section('element-titulo')     
@stop
@section('element-contenido')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if(isset($error))
            {{-- Mensaje de datos incorrectos--}}
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Datos incorrectos</p>
            </div>
            @endif
            @if(isset($mensaje))
            {{-- Mensaje de enlace de recuperar contraseña mandado al email--}}
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!!$mensaje!!}
            </div>
            @endif
            @if(count($errors)>0)
            {{-- Mensaje de validación de los campos del formulario --}}
            <div class="alert alert-danger alert-dismissable fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>Corrige los siguientes errores:</p>
                @foreach($errors->all() as $error)
                <p>{!! $error !!}</p>
                @endforeach
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Acceso Usuarios</h1></div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'login']) !!}
                    <div class="form-group">
                        {!!Form::label('email','Email', ['class' => 'control-label'])!!}
                        {!!Form::text('email',null,['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('pass','Password', ['class' => 'control-label'])!!}
                        {!!Form::password('pass',['class' => 'form-control'])!!} <!--el campo password no recive un segundo parametro para el value (ni siquiera como null)-->
                    </div>
                    <div>
                        <span class='pull-left' >{{Html::link('/solicitaPass','¿Ha olvidado su contraseña?')}}</span>
                    </div>
                    <div class="form-group">
                        {!!Form::submit('Aceptar',['class' => 'btn btn-primary pull-right'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
