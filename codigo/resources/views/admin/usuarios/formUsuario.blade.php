@extends('layouts.plantilla')

@section('migas')
    <li class="active">Inicio</li>
@stop
@section('titulo')
    Usuarios
@stop

@section('contenido')

    <div class="row">


        <h2>Crear usuarios</h2>

        {!! Form::open(array('action'=>'admin\UsuarioController@crear','role'=>'form')) !!}
        <div class="form-group">
            {!! Form::label('nombre','Nombre') !!}
            {!! Form::text('nombre',null,array('placeholder'=>'Nombre','class'=>'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email','Correo electronico') !!}
            {!! Form::email('email',null,array('placeholder'=>'example@email.com','required','class'=>'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('rol','Privilegio') !!}
            {!! Form::select('rol',$roles,null,array('class'=>'form-control'))!!}

        </div>
        <div class="form-group">
            {!! Form::label('password','Contraseña') !!}
            {!! Form::password('password',array('class'=>'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','Repite contraseña') !!}
            {!! Form::password('password_repeat',array('class'=>'form-control')) !!}

        </div>

        <div class="form-group">

            {!! Form::submit('Crear',['class'=>'btn  btn-primary']) !!}

        </div>

        {!! Form::close() !!}

        @if(isset($mensaje_error))
            <div class="alert alert-danger alert-dismissable fade in" id="msg_error" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {!! $mensaje_error!!}

            </div>
            <?php unset($mensaje_error); ?>
        @endif
        @if(isset($mensaje))
            <div class="alert alert-success alert-dismissable fade in" id="msg_success" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {!! $mensaje !!}
            </div>
            <?php unset($mensaje); ?>
        @endif

        @if (count($errors)>0)
            <div class="alert alert-danger alert-dismissable fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @foreach($errors->all() as $error)

                    {!! $error !!}
                @endforeach
            </div>
        @endif
    </div>


@endsection
@section('scripts')

    <script type="text/javascript">

        window.setTimeout(function () { // hide alert message
            $("#msg_success").removeClass('in');
            $("#msg_error").removeClass('in');
        }, 3000);


    </script>
@endsection
