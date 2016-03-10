@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
    <style type="text/css"> body {
            background-color: #269abc;
        }

        .infoextra {
            display: inline-flex;
            margin-left: 7.5%;
            padding: 1%;
            text-align: center;
        }

        #contenedorinfo {

        }

        textarea {
            resize: none;
        }

        #textarea1 {
            width: 50%;
        }

        #info2 {
            text-align: center;
        }

        span {
            display: none;
        }
    </style>

@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Resumen encuestas alumnos</li>
@stop
@section('titulo')
    Encuestas
@stop
@section('contenido')
    <div class="row">
        <div class="col-md-12" style="margin-left: auto; margin-top: auto; width: auto;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <th>Encuesta</th>
                            @foreach($preguntas as $preg)
                                <th>{!! $preg !!}</th>
                            @endforeach
                            <th>Media</th>
                            </thead>
                            <tbody>
                            <span>{!! $cont = 0 !!}</span>
                            <span>{!! $media = 0 !!}</span>
                            @foreach($encuestas as $enc)
                                @if($cont%10 == 0)
                                    <tr>
                                        <td>
                                            {!! $enc->IDENCUESTA !!}
                                        </td>
                                        @endif
                                        <td>
                                            {!! $enc->IDOPCION !!}
                                        </td>
                                        <span>{!! $cont++ !!}</span>
                                        @endforeach
                                                <!-- Medias de las encuestas -->
                                        @for($i=0;$i<count($medias_encuestas);$i++)
                                            @if($i%10==0)
                                                <td>
                                                    {!! floor($medias_encuestas[$i]) !!}
                                                </td>
                                            @endif
                                        @endfor

                                    </tr>
                                    <!-- Medias de las preguntas -->
                                    <tr>
                                        <td>Media</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
