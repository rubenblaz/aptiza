@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style type="text/css">
        body {
            background-color: #269abc;
        }
        input[type="checkbox"]{

        }
    </style>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Alta empresas</li>
@stop
@section('titulo')
    Alta de empresas
@stop
@section('contenido')
    <div class="row">
        <div class="col-md-12" style="margin-left: auto; margin-top: auto;">
            @if(Session::has('empresafav'))
                @if(Session::get('empresafav') == "ok")
                    <div class="alert alert-success alert-dismissable fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Modificado correctamente.
                    </div>
                @else
                    <div class="alert alert-danger alert-dismissable fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Fallo al modificar.
                    </div>
                @endif
            @endif
            <div class="panel panel-default">
                <br>
                {!! Form::open(array('action' => 'FCT\usuarios@empresas_favoritas')) !!}
                <div class="row">
                    <div id="botonayuda" class="col-md-6">
                        <a href="#top"><img src="img/FCT/ayuda.png" style="width: 6%; margin-left: 3%;" alt="Ayuda"/></a>
                    </div>
                    <div id="ayuda" class="col-md-6" style="display:none;" title="Ayuda">
                        <ul>
                            <li>Para borrar una empresa de favoritas, pulsar sobre el icono de la papelera de reciclaje <i class="glyphicon glyphicon-trash"></i>.</li>
                            <li>Para añadir empresas a las favoritas, seleccionarlas con las casillas y hacer click en aceptar <i class="glyphicon glyphicon-check"></i>.</li>
                            <li>El icono de la papelera <i class="glyphicon glyphicon-trash"></i> solo pone la empresa en NO FAVORITA. En ningún momento borra ningún dato de la empresa.</li>
                        </ul>
                    </div>
                </div>
                <hr>
                <br>
                <center><b><p>Listado completo de todas las empresas disponibles:</p></b></center>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <th>CIF</th>
                        <th>Población</th>
                        <th>Provincia</th>
                        <th>Teléfono</th>
                        <th>Nombre</th>
                        <th>Alias</th>
                        <th>¿Favorita?</th>
                        </thead>
                        <tbody>
                        @foreach($empresas as $emp)
                            <tr>
                                <td>{{ $emp->CIF }}</td>
                                <td>{{ $emp->POBLACION }}</td>
                                <td>{{ $emp->PROVINCIA }}</td>
                                <td>{{ $emp->TELEFONO }}</td>
                                <td>{{ $emp->NOMBRE }}</td>
                                <td>{{ $emp->ALIAS }}</td>
                                <td>
                                    @if($emp->FAVORITA == "SI") <!-- Preguntar a fernando que hacer en el caso de que sea favorita y en el caso de que no -->
                                    <a href="{{URL::to('/borrar', $emp->CIF)}}"
                                       title="Borrar empresa de favoritas">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                    {{--<a href="{{route('/borrar', ['CIF'=>$emp->CIF])}}">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>--}}
                                    @else
                                        {!! Form::checkbox('favoritas[]', $emp->CIF, false) !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $empresas->render() !!}
                <center>{!! Form::submit('Aceptar', array('class'=>'btn btn-success')) !!}</center>
                <br>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="jquery-1.12.0.min.js">
        $('.input_class_checkbox').each(function () {
            $(this).hide().after('<div class="class_checkbox" />');

        });
        $('.class_checkbox').on('click', function () {
            $(this).toggleClass('checked').prev().prop('checked', $(this).is('.checked'))
        });
    </script>
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function () {
            $("#botonayuda").on("click", function () {
                $("#ayuda").toggle("fast");
            });
        });
    </script>
@stop
