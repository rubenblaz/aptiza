@extends('layouts.plantilla')

@section('migas')
    <li class="active">Inicio</li>
@stop
@section('titulo')
    Usuarios
@stop

@section('contenido')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if($usuarios_vec)

                @foreach($usuarios_vec as $user)


                    {!! Form::open(array('action'=>'admin\UsuarioController@actualizar','role'=>'form')) !!}
                    {!! Form::hidden('email_anterior',$user->EMAIL) !!}
                    <div class="form-group">
                        {!! Form::label('nombre','Nombre') !!}
                        {!! Form::text('nombre',$user->NOMBRE,array('class'=>'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email','Correo electronico') !!}
                        {!! Form::email('email',$user->EMAIL,array('required','class'=>'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('rol','Privilegios:') !!}
                        <br>

                        @foreach($roles as $key=>$rol)


                              @if(in_array($key,$roles_usuario))
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('roles_selec[]',$key,true)!!}
                                        {!! $rol !!}
                                    </label>
                                </div>
                                  @else
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('roles_selec[]',$key,false)!!}
                                        {!! $rol !!}
                                    </label>
                                </div>
                                    @endif
                        @endforeach

                    </div>
                    <div class="form-group">
                        {!! Form::submit('Guardar',['class'=>'btn  btn-success']) !!}
                    </div>
                    {!! Form::close() !!}


        

        @endforeach
        @endif
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


@endsection