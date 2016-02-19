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
    @endif
</div>
