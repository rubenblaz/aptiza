@extends('layouts.plantilla_login')
@section('contenido')
            @if(isset($error))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Datos incorrectos</p>
            </div>
            @endif
            @if(isset($mensaje))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!!$mensaje!!}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Tipo de Usuario</h1></div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'elegirinicio']) !!}
                    <div class="form-group">
                        {!!Form::radio('administrador',true,['class' => 'form-control'])!!}
                        {!!Form::label('Administrador','Administrador', ['class' => 'control-label'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::radio('administrador',false,['class' => 'form-control'])!!} 
                        {!!Form::label('Administrador','Usuario', ['class' => 'control-label'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::submit('Aceptar',['class' => 'btn btn-primary pull-right'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
@stop
