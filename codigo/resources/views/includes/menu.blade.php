
<ul class="nav navbar-nav navbar-left">
    <li><a href="{{ url('inicio') }}"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
    <!--reservas elemento de menu-->
    @if(Session::get('USUARIO')->hasRol(2))
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Rerservas<span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>{{Html::link('toreservas','Reservar Aula')}}</li>
            <li>{{Html::link('tomisreservas','Mis reservas')}}</li>
        </ul>
    </li>
    @endif
    <!-- Siguiente elemento de menu -->
    @if(Session::get('USUARIO')->hasRol(2))
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Informes<span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>{{Html::link('informes/elegirGrupo','Calificar')}}</li>
            @if(Session::get('USUARIO')->hasRol(1))
            <li>{{Html::link('informes/generarInforme','Generar')}}</li>
            @endif
        </ul>
    </li>
    @endif  
    <!-- Usuario elemento de menu ¡Siempre al final! -->
    @if(Session::get('USUARIO')->hasRol(0))

    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="true">
            Admin reservas<span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li>{{Html::link('admin-aulas','Admin-Aulas')}}</li>
            <li>{{Html::link('admin-horas','Admin-Horas')}}</li>

        </ul>

    </li>
    <li>{{Html::link('admin-usuarios/listar','Usuarios')}}</li>
    <li>{{Html::link('importacion','Importar')}}</li>
    @endif
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span class='glyphicon glyphicon-user'></span>{{Session::get('USUARIO')->getNombre()}}<span class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>{{Html::link('perfilUsuario','Perfil')}}</li>
            <li><a href="{{url('logout')}}"><span class='glyphicon glyphicon-log-out' style="margin-right:5px"></span>Salir</a></li>
        </ul>
    </li>
</ul>