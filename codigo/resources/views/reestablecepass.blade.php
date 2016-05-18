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
    <div class="panel-heading"><h1>Restablecer contraseña para {!!$email!!}</h1></div>
    <div class="panel-body">
        {!! Form::open(['url'=>'/solicitaPass/establecePass']) !!}
        <div class="form-group">
            {!!Form::label('pass','Password', ['class' => 'control-label'])!!}
            {!!Form::password('pass',['class' => 'form-control'])!!} <!--el campo password no recive un segundo parametro para el value (ni siquiera como null)-->
        </div>
        <div class="form-group">
            {!!Form::label('repass','Confirme Password', ['class' => 'control-label'])!!}
            {!!Form::password('repass',['class' => 'form-control'])!!} <!--el campo password no recive un segundo parametro para el value (ni siquiera como null)-->
        </div>
        <div class="form-group">
            {!!Form::submit('Aceptar',['class' => 'btn btn-primary pull-right'])!!}
        </div>
        {!!Form::close()!!}
    </div>
</div>

@endsection