@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" type="text/css" href="css/fileinput.css">
    @endsection
@section('migas')
    <li class="active">Inicio</li>
@stop
@section('titulo')
    Crear usuarios
@stop

@section('contenido')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        {!! Form::open(array('action'=>'admin\ImportController@guardarArchivo','method'=>'POST','files'=>true)) !!}
        <div class="form-group">
            {!! Form::label('Asignaturas','Asignaturas') !!}
            {!! Form::file('fileAsignaturas',array('class'=>'file','data-show-preview'=>'false')) !!}
        </div>
            <div class="form-group">
                {!! Form::label('Alumnos','Alumnos') !!}
                {!! Form::file('fileAlumnos',array('class'=>'file','data-show-preview'=>'false')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Profesores','Profesores') !!}
                {!! Form::file('fileProfesores',array('class'=>'file','data-show-preview'=>'false')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Unidades','Unidades') !!}
                {!! Form::file('fileUnidades',array('class'=>'file','data-show-preview'=>'false')) !!}
            </div>

        <div class="form-group">

            {!! Form::submit('Guardar',['class'=>'btn  btn-primary']) !!}

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
</div>

@endsection
@section('scripts')
    <script type="text/javascript" src="js/fileinput.js"></script>
    <script type="text/javascript" src="js/fileinput_locale_es.js"></script>

    <script type="text/javascript">

        window.setTimeout(function () { // hide alert message
            $("#msg_success").removeClass('in');
            $("#msg_error").removeClass('in');
        }, 3000);
        $(".file").fileinput({
            language: "es",
            allowedFileExtensions: ["csv","xml"],
            showUpload:false

        });


    </script>
@endsection
