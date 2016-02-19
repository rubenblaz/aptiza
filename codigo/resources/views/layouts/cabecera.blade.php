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

        <style>
            body {
                font-family: 'Lato';
            }
            .cabecera-menu{
                background-color: #215891;
                height: 100px;
            }
            .logo-cabecera{
                margin-top:10px;
            }
            .centro-logo-cabecera{
                color:white;
                font-family: 'Lato';
                margin-left:10px;
                margin-top:15px;
                font-size: 2em;
            }
            .centro-logo-collapse{
                width: 95px;
                position:relative;
                top:-13px;
            }
            .glyphicon{
                margin-right: 5px;
            }
            
            @media (max-width: 768px) {
                .cabecera-menu {
                    display: none;
                }
                .navbar-brand{
                    display:inline;
                }
            }
            @media (min-width: 768px) {
                .navbar-brand{
                    display:none;
                }
            }
        </style>
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
                                  <img src="img/centro_logo.jpg"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <img src='img/aptiza_logo.png' class="logo-cabecera pull-right"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner Menu -->
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

                                <!--Reservas elemento de menu-->
                                <li class="dropdown">
                                    <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Rerservas<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li>{{Html::link('toreservas','Reservar Aula')}}</li>
                                        <li>{{Html::link('tomisreservas','Mis reservas')}}</a></li>
                                    </ul>
                                </li>

                                <!-- Usuario elemento de menu -->
                                <li class="dropdown">
                                    <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class='glyphicon glyphicon-user'></span>{{Session::get('USUARIO')->getNombre()}}<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="{{url('logout')}}"><span class='glyphicon glyphicon-log-out' style="margin-right:5px"></span>Salir</a></li>
                                    </ul>
                                </li>

                                <!-- Siguiente elemento de menu -->

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </nav>

        @yield('content')

        <!-- JavaScripts CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('scripts')

</body>
</html>
