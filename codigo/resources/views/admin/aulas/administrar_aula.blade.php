@extends('layouts.plantilla')
@include ('admin.aulas.modal')
@section('migas')
    <li class="active">Inicio</li>
@stop
@section('titulo')
   Aulas
@stop

@section('contenido')


    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            {!! Form::open(array('action'=>'reservas\reservasAdminController@crear_aulas','role'=>'form','class'=>'form-inline')) !!}
            <div class="form-group">

                {!! Form::text('nombre_aula',null,array('placeholder'=>'Nombre de aula','required','class'=>'form-control')) !!}
            </div>

            <div class="form-group">

                {!! Form::submit('Crear',['class'=>'btn  btn-primary']) !!}

            </div>
            {!! Form::close() !!}
            <br>
            </div>



                @if($aulas!=[])
                    <table class="table-hover table">
                    <th>Aula</th>
                    <th colspan="2">Operaciones</th>
                    @foreach($aulas as $nombre)
                        <tr>

                            <td>{!! $nombre->AULA !!}</td>
                            <td><a href="{{ URL::to('/admin-aulas/aula_eliminada',$nombre->AULA) }}">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                            <td>
                                <a data-toggle="modal"
                                   data-value="{{$nombre->AULA}}"
                                   data-target="#modalAula" onclick="editar_aula(this);">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
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
                <div class="alert alert-danger alert-dismissable fade in"  id="msg_success" role="alert">
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

    <script>
        function editar_aula(aula_edit) {
            $("#aula_editada").attr("value", $(aula_edit).attr('data-value'));

        }
        window.setTimeout(function() { // hide alert message
            $("#msg_success").removeClass('in');
            $("#msg_error").removeClass('in');
        }, 33000);

    </script>


@endsection
