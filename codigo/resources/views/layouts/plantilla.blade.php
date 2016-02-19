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
                background-color:black !important;
                background-image: url('img/background.jpg');
                background-size:cover;
                background-repeat: no-repeat;
            }

            /*---Cabecera y Menú ----*/
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
            /*--- Contendio ----*/

            section{
                background-color: white;
                padding: 20px;
                padding-top: 30px;

            }
            .titulo{
                border-bottom: solid 1px #215891;
                color:#215891;
                height: 50px;
                margin-bottom: 20px;
                margin-bottom: 50px;
                background-color: white;
            }
            .titulo h3{
                line-height: 30px;
            }
            .articulo > h4{
                margin: 30px 0px 30px 0px;
            }
            .articulo  li{
                margin-bottom: 40px;
            }
            .articulo-fondo{
                background-color: #215891;
                color:white;
                font-weight:lighter;
            }
            article{
                margin-bottom: 10px;
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
            @include('includes.menu')
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
