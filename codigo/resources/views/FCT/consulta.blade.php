@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style type="text/css">
        body {
            background-color: #269abc;
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
        <div class="col-md-7" style="margin-left: 20%; margin-top: 12%;">
            <div class="panel panel-default">
                <center><b><p>Listado completo de todas las empresas disponibles:</p></b></center>
                <br>
                {!! Form::open(array('action' => 'FCT\usuarios@empresas_favoritas')) !!}
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
                <center>{!! Form::submit('Aceptar', array('class'=>'btn btn-success')) !!}</center>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@section('scripts')
    <script src="jquery-1.12.0.min.js">
        $('.input_class_checkbox').each(function () {
            $(this).hide().after('<div class="class_checkbox" />');

        });
        $('.class_checkbox').on('click', function () {
            $(this).toggleClass('checked').prev().prop('checked', $(this).is('.checked'))
        });
    </script>
@stop
