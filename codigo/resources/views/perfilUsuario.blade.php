@extends('layouts.plantilla')



@section('migas')
    <li>{!!Html::link('inicio','Inicio')!!}</li>
    <li><a href="#"></a>Perfil Usuario</li>
@stop
@section('titulo')
    Perfil Usuario
@stop
@section('contenido')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">


            <div class="col-md-5">
                <img src="img/icon-profile.png" class="img-rounded img-responsive"/>
                <br/>
                <br/>
            </div>
            <div class="form-group col-md-5">
                <h3>Detalles usuario</h3>
                {!! Form::open(array('action'=>'Usuarios@editarPerfil','role'=>'form')) !!}
                <div class="form-group">
                    {!! Form::label('nombre','Nombre') !!}
                    {!! Form::text('nombre',Session::get('USUARIO')->getNombre(),array('class'=>'form-control')) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('email','Correo electronico') !!}
                    {!! Form::email('email',Session::get('USUARIO')->getEmail(),array('disabled','class'=>'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Guardar',['class'=>'btn  btn-success']) !!}
                </div>
                {!! Form::close() !!}

            </div>
            <div class="form-group col-md-10">
                {!! Form::open(array('action'=>'Usuarios@editarPassword','role'=>'form')) !!}
                <h3>Cambiar contraseña</h3>
                <br/>
                <div class="form-group">
                    {!! Form::label('password_anterior','Contraseña anterior') !!}
                    {!! Form::password('password_anterior',array('class'=>'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_nuevo','Nueva contraseña') !!}
                    {!! Form::password('password_nuevo',array('class'=>'form-control')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_repetir','Repite la contraseña') !!}
                    {!! Form::password('password_repetir',array('class'=>'form-control')) !!}
                </div>
                <br>
                <div class="form-group">
                    {!! Form::submit('Cambiar contraseña',['class'=>'btn  btn-warning']) !!}
                </div>
                {!! Form::close() !!}
                <br/><br/>
                @if(isset($mensaje_error))
                    <div class="alert alert-danger alert-dismissable fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {!! $mensaje_error !!}
                    </div>
                    <?php unset($mensaje_error); ?>
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


        </div>

    </div>

        <!-- ROW END -->


@stop







