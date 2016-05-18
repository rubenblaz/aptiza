<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" />

        <title>Aptiza</title>

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
        <div class="container">
            <div class="row">
                <div class="cabecera-menu col-md-10 col-md-offset-1 col-xs-12">
                    <div class="col-lg-6 col-md-6 pull-left">
                        <div class="centro-logo-cabecera">
                            <a href="{{ url('inicio') }}">
                                {{ HTML::image('img/centro_logo.jpg','Imagen logo del centro',['class' => '']) }}
                            </a>
                        </div>
                    </div>
                    <div class="ccol-lg-6 col-md-6">
                        <a href="{{ url('inicio') }}">
                            {{ HTML::image('img/logo_aptiza.svg','Imagen aptiza logo',['class' => 'logo-cabecera pull-right img-responive']) }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="menu col-md-10 col-md-offset-1 col-xs-12">
                    <nav class="navbar navbar-inverse">
                        <!-- Header Menu -->
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
                                    {{ HTML::image('img/centro_logo.jpg', 'Marca de Aptiza', array('class' => 'centro-logo-collapse')) }}
                                </a>
                            </div>
                            @if(Session::has('USUARIO'))
                                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                    <!-- Elementos del menu según si esta logeado y el rol -->
                                        @include('includes.menu')
                                </div>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
                <div class="row">
                    @section('element-migas')
                    <ol class="breadcrumb col-md-10 col-md-offset-1 col-xs-12">
                        @yield('migas')
                    </ol>
                    @show

                    @section('element-titulo')
                    <div class="titulo col-md-10 col-md-offset-1 col-xs-12">
                        <h1>
                            @yield('titulo')
                        </h1>  
                    </div>
                    @show

                    @section('element-contenido')
                    <section class="col-md-10 col-md-offset-1 col-xs-12">
                        @yield('contenido')
                    </section>
                    @show
                </div>
            <div class="row">
                <footer class="col-md-10 col-md-offset-1 col-xs-12"></footer>
            </div>
        </div>
        <!-- JavaScripts CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>
