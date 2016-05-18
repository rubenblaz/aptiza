@extends('layouts.plantilla_login')
@section('contenido')
@if (count($errors)>0)
<div class="alert alert-danger alert-dismissable fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    @foreach($errors->all() as $error)
    {!! $error !!}
    @endforeach
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading"><h1>Recuperar Contraseña</h1></div>
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
@stop
