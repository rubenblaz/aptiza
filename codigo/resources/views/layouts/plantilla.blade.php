<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fray Andres</title>

        <!-- Fuentes -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <!-- Estilos -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
        {!!Html::style('css/aptiza.css')!!}


        @if(Session::has('USUARIO') and Session::get('USUARIO')->hasRol(0))
        <!--Carga el estilo del administrador si el usuario tiene el rol 0-->
        {!!Html::style('css/admin_aptiza.css')!!}
        @endif

        @yield('customcss')
    </head>
    <body id="app-layout">
        <nav class="navbar navbar-inverse">
            <!-- Header Menu -->
            <div class="cabecera-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 pull-left">
                            <div class="centro-logo-cabecera">
                                <a href="{{ url('inicio') }}">
                                    <img src="img/centro_logo.jpg"/>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <a href="{{ url('inicio') }}">
                                <img src='img/aptiza_logo.png' class="logo-cabecera pull-right"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="navbar-header">
                    @if(Session::has('USUARIO'))
                    <!-- Boton menu responsive -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @endif
                    <!-- Zona de logo -->
                    <a class="navbar-brand" href="{{ url('inicio') }}">
                        <img src="img/centro_logo.jpg" class="centro-logo-collapse" />
                    </a>
                </div>
                @if(Session::has('USUARIO'))
                <div class="row">
                    <div class="col-lg-8 col-md-10 col-lg-offset-2 col-md-offset-1">
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Elementos del menu según si esta logeado y el rol -->
                            <ul class="nav navbar-nav navbar-left">
                                <li><a href="{{ url('inicio') }}"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Aquí se incluyen los elementos de menú dependiendo del rol-->
                                @include('includes.menu')
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </nav>

        <div class="container">
            <div class="row">
                @section('element-migas')
                <ol class="breadcrumb col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
                    @yield('migas')
                </ol>
                @show

                @section('element-titulo')
                <div class="titulo col-md-10 col-lg-offset-1 col-md-offset-1">
                    <h3>
                        @yield('titulo')
                    </h3>  
                </div>
                @show

                @section('element-contenido')
                <section class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
                    @yield('contenido')
                </section>
                @show
            </div>
        </div>

        <!-- JavaScripts CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('scripts')

</body>
</html>
