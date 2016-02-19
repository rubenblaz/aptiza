@extends('layouts.plantilla')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(isset($error))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Datos incorrectos</p>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Reestablecer contraseña para <b>{!!$email!!}</b></div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'cambiarpass'])!!}
                    <div class="form-group">
                        {!!Form::label('pass','Password', ['class' => 'control-label'])!!}
                        {!!Form::password('pass',['class' => 'form-control','required' => 'true'])!!} <!--el campo password no recive un segundo parametro para el value (ni siquiera como null)-->
                    </div>
                    <div class="form-group">
                        {!!Form::label('repass','Confirme Password', ['class' => 'control-label'])!!}
                        {!!Form::password('pass',['class' => 'form-control','required' => 'true'])!!} <!--el campo password no recive un segundo parametro para el value (ni siquiera como null)-->
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
@endsection