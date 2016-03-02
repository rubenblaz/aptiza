@extends('layouts.plantilla')
@include ('admin.horas.modal')


@section('customcss')
    <link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.min.css">
@endsection
@section('migas')
    <li class="active">Inicio</li>
@stop
@section('titulo')
    Horas
@stop


@section('contenido')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            {!! Form::open(array('action'=>'reservas\reservasAdminController@crear_horas','role'=>'form','class'=>'form-inline')) !!}
            <div class="form-group">
                <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" class="form-control" name="timepicker"
                           value="08:30">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
                </div>

            </div>


            <div class="form-group">

                {!! Form::submit('Crear',['class'=>'btn  btn-primary']) !!}

            </div>
            {!! Form::close() !!}




        @if($horas_vec!=[])
            <table class="table-hover table">
                <th>Hora</th>

                <th colspan="2"> Operaciones</th>


                @foreach($horas_vec as $key=>$horas)
                    <tr>
                        <td>{!! $horas->HORA !!}</td>
                        <td>
                            <a data-toggle="modal"
                               href="#"
                               data-value="{{$horas->NUMHORA}}"
                               data-target="#modalHora" onclick="editar_hora(this);">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                        </td>

                        <td>
                            @if($key == count($horas_vec)-1)

                                <a href="{{ URL::to('/admin-horas/hora_eliminada',$horas->NUMHORA) }}">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            @endif
                        </td>
                    </tr>

                @endforeach
            </table>
        @else
            <div class="alert alert-info alert-dismissable " id="msg_nodata" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                No existen datos
            </div>
        @endif

        @if(isset($mensaje_error))
            <div class="alert alert-danger alert-dismissable fade in" id="msg_success" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {!! $mensaje_error !!}
            </div>
        @endif
        @if(isset($mensaje))
            <div class="alert alert-success alert-dismissable fade in" id="msg_error" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {!! $mensaje !!}
            </div>
        @endif
    </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="js/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker({

            align: 'right'
        });
        function editar_hora(hora_edit) {
            $("#hora_editada").attr("value", $(hora_edit).attr('data-value'));
        }
        window.setTimeout(function () { // hide alert message
            $("#msg_success").removeClass('in');
            $("#msg_error").removeClass('in');
        }, 3000);
    </script>
@endsection