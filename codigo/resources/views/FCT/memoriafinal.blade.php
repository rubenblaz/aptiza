@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style type="text/css">
        table {
            margin-top: 1.5%;
        }

        span {
            display: none;
        }

        .fechas {
            font-size: smaller;
        }

        .table-responsive {
            font-size: 0.8em;
        }

        .inputs {
            font-size: 1em !important;
        }

        textarea {
            resize: none;
        }
        input[type="checkbox"]{

        }
    </style>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Memoria final</li>
@stop
@section('titulo')
    Memoria final
@stop
@section('contenido')
    {!! Form::open(array('action' => 'FCT\PdfController@invoice2')) !!}
    <div class="row">
        <div class="col-md-12">
            <p>
                <b>Tutor: </b> {!! Form::text('nombre_tutor', Session::get('nombre_tutor') . ", " . Session::get('apellidos_tutor'), array('class'=>'form-control','title'=>'Nombre y apellidos de tutor', 'disabled')) !!}
            </p>
            <p>
                <b>Grupo: </b> {!! Form::text('nombre_grupo', Session::get('nombre_grupo'),array('class'=>'form-control','disabled','title'=>'Nombre del grupo')) !!}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="from-group">
            <div class="col-md-12">
                {!! Form::label('Curso académico: ') !!}
                {!! Form::text('curso_academico', null, array('placeholder'=>'2016/2017', 'class'=>'form-control', 'required', 'title'=>'Curso académico')) !!}
            </div>

        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
            <th>Nº</th>
            <th>Alumno</th>
            <th>Empresa</th>
            <th>Nº Convenio</th>
            <th>Tfno móvil</th>
            <th>Tfno fijo</th>
            <th>E-mail</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>¿Apto?</th>
            <hr>
            </thead>
            <tbody>
            <span>{!! $cont = 0 !!}</span>
            @foreach($mis_alumnos as $al)
                <tr>
                    <td>
                        {!! $cont !!}
                    </td>
                    <td>
                        {!! Form::textarea('nombre_apellidos[]', $al->APELLIDOS . ", " . $al->NOMBRE, array('class'=>'form-control inputs', 'rows'=>'4', 'title'=>'Nombre y apellidos')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('nombre_e[]', $al->NOMBRE_E ,array('class'=>'form-control inputs', 'rows'=>'4', 'title'=>'Nombre empresa')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('convenio[]', $al->CONVENIO ,array('class'=>'form-control inputs', 'rows'=>'4', 'title'=>'Convenio')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('telefono_m[]', $al->TELEFONO_M ,array('class'=>'form-control inputs','rows'=>'4', 'title'=>'Telefono movil')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('telefono_f[]', $al->TELEFONO_F ,array('class'=>'form-control inputs', 'rows'=>'4','title'=>'Telefono fijo')) !!}
                    </td>
                    <td>
                        {!! Form::textarea('email[]', $al->EMAIL ,array('class'=>'form-control inputs','rows'=>'4', 'title'=>'Email')) !!}
                    </td>
                    <td>
                        {!! Form::date('fecha_inicio[]', null, array('class'=>'form-control fechas', 'title'=>'Fecha de inicio')) !!}
                    </td>
                    <td>
                        {!! Form::date('fecha_fin[]', null, array('class'=>'form-control fechas', 'title'=>'Fecha de fin')) !!}
                    </td>
                    <td>
                        {!! Form::text('aptos[]', "S", ['title'=>'¿Apto o no apto?', 'class'=>'form-control inputs']) !!}
                    </td>
                </tr>
                <span>{!! $cont++ !!}</span>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <center>{!! Form::submit('Generar PDF', array('class'=>'btn btn-success', 'title'=>'Crear PDF')) !!}</center>
    {!! Form::close() !!}
@stop
@section('scripts')
@stop