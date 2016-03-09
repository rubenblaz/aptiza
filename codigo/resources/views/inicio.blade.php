@extends('layouts.plantilla')
@section('customcss')



@endsection
@section('migas')
                <li class="active">Inicio</li>
@stop
@section('titulo')
    Inicio
@stop

@section('contenido')
            <div class='row'>
            <article class="articulo col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
               <!--Espacio-->
               <img class='img-responsive'src="img/aptiza_logo_invert.png" alt="Logo del sitio" />
            </article>
            <article class="col-md-6 col-sm-6 col-xs-12">
                <h1 class="text-right">Herramienta de gestión para docentes.</h1>
            </article>
            <article class="articulo col-md-6 col-sm-6 col-xs-12 col-sm-offset-0 col-md-offset-0 col-xs-offset-0">
                <img class=''src="img/ilus_llave.svg" alt="Ilustraciíon de llave inglesa" />
            </article>
            <article class="articulo col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>{!!Session::has('USUARIO')?"Bienvenido <span class='label label-primary'>".Session::get('USUARIO')->getNombre()."</span>":""!!}</h3>
                    <h3 class='text-right'>Realice las tareas de supervisión, coordinación, y generación de informes entre otras, de la manera más sencilla.
                        Y concentrese en lo más importante...</h3>
                <div class="col-md-10 col-md-offset-1"><h2>"...formar a las generaciones del futuro."</h2></div>
            </article>
                <article class="articulo articulo-fondo col-lg-6 col-md-6 col-md-offset-2 col-sm-6 col-xs-10 col-sm-offset-0 col-md-offset-0 col-xs-offset-2">
                    <ul>
                        <li>
                            <h3>Alumnos</h3>
                        </li>
                        <li>
                            <h3>Profesores</h3>
                        </li>
                        <li>
                            <h3>Tutores</h3>
                        </li>
                        <li>
                            <h3>Padres</h3>
                        </li>
                    </ul>
            </article>
            </div>
@stop

@section('scripts')

@stop
