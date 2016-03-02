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

            <a class=" btn btn-success" href="{{ URL::to('/admin-usuarios')}}">
                Crear usuario
            </a>

            <div class="table-responsive">
                <table class="table-hover table">
                    @if(isset($lista_usuarios))
                        <th>Nombre</th>
                        <th>Email</th>

                        <th colspan="3">Operaciones</th>

                        @foreach($lista_usuarios as $users)
                            <tr>
                                <td>{!! $users->NOMBRE !!}</td>
                                <td>{!! $users->EMAIL !!}</td>

                                <td><a href="{{ URL::to('/admin-usuarios/eliminar',$users->EMAIL) }}">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/admin-usuarios/editar',$users->EMAIL) }}">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/admin-usuarios/formPassword',$users->EMAIL) }}">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    @endif
                </table>
            </div>
            {{$lista_usuarios->render()}}
            @if(isset($mensaje_error))
                <div class="alert alert-danger alert-dismissable fade in" id="msg_success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!! $mensaje_error !!}
                </div>
                <?php unset($mensaje_error); ?>
            @endif
            @if(isset($mensaje))
                <div class="alert alert-success alert-dismissable fade in" id="msg_error" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!!$mensaje !!}
                </div>
                <?php unset($mensaje);?>
            @endif
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

        window.setTimeout(function () { // hide alert message
            $("#msg_success").removeClass('in');
            $("#msg_error").removeClass('in');
        }, 5000);

    </script>
@endsection
