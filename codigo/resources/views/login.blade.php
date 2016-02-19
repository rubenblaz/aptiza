@extends('layouts.plantilla')

        @if (isset($errors) && $errors->any())
            <p>Corrige los siguientes errores.</p>
            @foreach($errors->all() as $error)
                {!! $error !!}<br/>
            @endforeach
        @endif
@section('element-migas')
@stop
@section('element-titulo')     
@stop
@section('element-contenido')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'inicio']) !!}
                    <div class="form-group">
                        {!!Form::label('email','Email', ['class' => 'control-label'])!!}
                        {!!Form::email('email',null,['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('pass','Password', ['class' => 'control-label'])!!}
                        {!!Form::password('pass',['class' => 'form-control'])!!} <!--el campo password no recive un segundo parametro para el value (ni siquiera como null)-->
                    </div>
                    <div>
                        <span class='pull-left' >{{Html::link('pediremailpass','¿Ha olvidado su contraseña?')}}</span>
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
