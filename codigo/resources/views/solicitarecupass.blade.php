@extends('layouts.plantilla')

@section('element-migas')
@stop
@section('element-titulo')     
@stop
@section('element-contenido')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if (count($errors)>0)
                <div class="alert alert-danger alert-dismissable fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->all() as $error)
                        {!! $error !!}
                    @endforeach
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Recuperar Contraseña</div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'/solicitaPass/mandarPassEmail']) !!}
                    <div class="form-group">
                        {!!Form::label('email','Email', ['class' => 'control-label'])!!}
                        {!!Form::text('email',null,['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::submit('Aceptar',['class' => 'btn btn-primary'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
