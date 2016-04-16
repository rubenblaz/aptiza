<!--Reservas elemento de menu-->
@if(Session::get('USUARIO')->hasRol(1))
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="true">
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
        <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="true">
            Admin reservas<span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>{{Html::link('admin-aulas','Admin-Aulas')}}</li>
            <li>{{Html::link('admin-horas','Admin-Horas')}}</li>

        </ul>
    </li>
    <li class="dropdown">
        <!-- Elementos del administrador de FCTs rol 0 -->
        <a href='#' class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="true">
            Admin FCTs<span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li>{{Html::link('/altaempresas','Alta empresas')}}</li>
            <li>{{Html::link('/modempresas','Modificar empresas')}}</li>
        </ul>
    </li>
    <li>{{Html::link('admin-usuarios/listar','Usuarios')}}</li>
    @endif
            <!-- Siguiente elemento de menu -->

    <!-- ELEMENTOS DEL MÓDULO FCTS -->

    @if(Session::get('USUARIO')->hasRol(3)) <!-- Submenu del tutor FCT - rol 3 -->
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu3" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="true">
            Tutor FCT<span class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
            <li>{{ Html::link('/consulta', 'Consultar empresas') }}</li>
            <li title="Asignar empresas">{{ Html::link('/practicas', 'Asignar empresas') }}</li>
            {{--<li title="Solicitar encuestas">{{ Html::link('/solencuestas', 'Solicitar encuestas') }}</li>--}}
            <li title="Memoria final PDF">{{ Html::link('/memoria', 'Memoria final - PDF') }}</li>
            <li title="Memoria final Excel">{{ Html::link('/memoria2', 'Memoria final - Excel') }}</li>
            {{--<li title="Resumen alumnos">{{ Html::link('/resumenalumnos', 'Resumen encuestas alumnos') }}</li>--}}
            {{--<li title="Resumen empresas">{{ Html::link('/resumenempresas', 'Resumen encuestas empresas') }}</li>--}}
            <li title="Hoja de firmas de alumnos FCT">{{ Html::link('/informe1', 'Hoja de firmas de alumnos FCT') }}</li>
        </ul>
    </li>
    @endif
    @if(Session::get('USUARIO')->hasRol(4)) <!-- Submenu de la empresa FCT - rol 4 -->
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu4" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="true">
            Empresa FCT<span class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
            <li title="Encuestas">{{ Html::link('/encuestas4', 'Encuestas') }}</li>
        </ul>
    </li>
    @endif
    <!-- Submenu del alumno FCT - rol 6 -->
    @if(Session::get('USUARIO')->hasRol(6)) 
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu5" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="true">
            Alumno FCT<span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu5">
            <li title="Encuestas">{{ Html::link('/encuestas6', 'Encuestas') }}</li>
        </ul>
    </li>
    @endif
            <!-- Usuario elemento de menu ¡Siempre al final! -->
    <li class="dropdown">
        <a href='#' class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="true">
            <span class='glyphicon glyphicon-user'></span>{{Session::get('USUARIO')->getNombre()}}<span
                    class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{url('logout')}}"><span class='glyphicon glyphicon-log-out' style="margin-right:5px"></span>Salir</a>
            </li>
        </ul>
    </li>