    <!--reservas elemento de menu-->
@if(Session::get('USUARIO')->hasRol(1))
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
    <!-- Siguiente elemento de menu -->


    <!-- Usuario elemento de menu ¡Siempre al final! -->
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span class='glyphicon glyphicon-user'></span>{{Session::get('USUARIO')->getNombre()}}<span class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>{{Html::link('perfilUsuario','Perfil')}}</li>
            <li><a href="{{url('logout')}}"><span class='glyphicon glyphicon-log-out' style="margin-right:5px"></span>Salir</a></li>
        </ul>
    </li>