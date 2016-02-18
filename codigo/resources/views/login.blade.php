@extends('layouts.cabecera')

        @if (isset($errors) && $errors->any())
            <p>Corrige los siguientes errores.</p>
            @foreach($errors->all() as $error)
                {!! $error !!}<br/>
            @endforeach
        @endif

@section('content')
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
                    {!! Form::open(['route' => 'inicio', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {!!Form::label('email','Email', ['class' => 'control-label'])!!}
                        {!!Form::email('email',null,['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('pass','Password', ['class' => 'control-label'])!!}
                        {!!Form::password('pass',['class' => 'form-control'])!!} <!--el campo password no recive un segundo parametro para el value (ni siquiera como null)-->
                    </div>
                    <div>
                        <a class='pull-left' href="{{url('recuperapass')}}">¿Ha olvidado su contraseña?</a>
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
@endsection
