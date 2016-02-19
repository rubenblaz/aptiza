@extends('layouts.plantilla')

@section('customcss')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!-- CSS CND BOOTSTRAP-DATEPICKER -->
{!!Html::style('css/bootstrap-datepicker.min.css')!!}
{!!Html::style('css/bootstrap-datepicker3.css')!!}

<style>
    #horario{
        padding: 15px;
        border: 1px lightgray solid;
        border-radius: 5px;
    }
    #horariolistado{
        padding-left: 0px;
    }
    .hora{
        font-weight:bolder;
    }
    #horariolistado li{

        height: 50px;
        padding: 10px;
        padding-top:15px;
        list-style: none;
        border-radius: 0px;
        cursor:pointer;
        margin-bottom: 3px;
        border-bottom: 1px solid lightgray;
    }
    .seleccionada{
        background-color:lightskyblue !important;
        color: white;
    }
    .seleccionada:after{
        content: "\f00c";
        font-family: FontAwesome;
        font-size: 2em;
        position: relative;
        top:-10px;
        float:right;
        color:white;
        text-shadow: 1px 1px 2px blue;

    }
    .oldselect{

        background-color:lightcyan;
    }
    .hora{
        margin-right: 10px;
        font-weight:bolder;

    }
    .noseleccionable{
        border-bottom :1px solid transparent !important;
        color:white;
        background-color:pink !important;
    }
    .noseleccionable:before{
        content: "\f00d";
        font-family: FontAwesome;
        font-size: 2em;
        position: relative;
        top:-10px;
        float:right;
        color:white;

    }
    #contenedor_aula_horario{
        float:left;
        width: 60%;
        margin-left: 30px;
    }
    #loading{
        display: table;
        position:absolute;
        top: 70px;
        left: 0px;
        width:100%;
        height: 375px;
        background: rgba(255,255,255,0.8);
    }
    #loading p{
        display:table-cell;
        vertical-align:middle;
        text-align: center;
        font-size: 2em;
        color:lightskyblue;
    }
    
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- Zona de Mensajes al usuario -->
            <div id="zona_mensajes"></div>
            @if(!empty($tipomensaje))
                @if($tipomensaje == 'ok')
                <div class="alert alert-success" role="alert">{!!$mensaje!!}</div>
                @elseif($tipomensaje == 'error')
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    {!!$mensaje!!}
                </div>
                @endif
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Reservas</div>
                <div class="panel-body">
                    <div class="row">
                        {!! Form::open(['url'=>'reservar', 'method' => 'POST']) !!}
                        <div class="form-group col-md-4 col-sm-12">
                            <!-- Input Fecha, utilizando el Datepicker -->
                            @if(isset($fecha))
                            <div id="datepicker" data-date="{{$fecha}}" ></div> <!--Si viene de editar de la sección de Mis reservas-->
                            <input name="fecha" hidden value="{{$fecha}}" id="input_fecha_oculto">
                            @else
                            <div id="datepicker" data-date="{{\Carbon\Carbon::today()->format('Y/m/d')}}" ></div> <!-- Toma esta fecha para establecer el dia de hoy del datepicker -->
                            <input name="fecha" hidden value="{{\Carbon\Carbon::today()->format('Y/m/d')}}" id="input_fecha_oculto">
                            @endif
                        </div>
                        <div class='col-md-8 col-sm-12'>
                            <!-- Select Aulas -->
                            <div class="form-group">
                                {!!Form::label('aula','Aulas', ['class' => 'control-label'])!!}
                                @if(isset($aula))
                                {!! Form::select('aula',$aulas, $aula,['class' => 'form-control']) !!}
                                @else
                                {!! Form::select('aula',$aulas, $aulaselec,['class' => 'form-control']) !!}
                                @endif
                            </div>
                            <!-- Plantilla de horario -->
                            <div  id='horario' class="form-group">
                                <div id="loading" style="display:none"><p>Cargando...</p></div>
                                <ul id='horariolistado'>
                                    @foreach($horario as $idhora => $hora)
                                    <li id='{{$idhora}}' class="">
                                        <span class="hora">{!!$hora!!}</span>
                                        <span class='reserva'></span>
                                        {!!Form::checkbox('horas[]',$idhora,false,['class'=>'pull-right clearfix','hidden'=>'true'])!!}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="form-group" style="clear:both">
                                {!!Form::submit('Aceptar',['class' => 'btn btn-info pull-right'])!!}
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')

    <!-- JAVASCRIPT CND BOOTSTRAP-DATEPICKER -->
    <!-- Respetar el orden de importación -->
    {!!Html::script('js/bootstrap-datepicker.js')!!}
    {!!Html::script('js/bootstrap-datepicker.es.min.js')!!}
    <script>
    $('document').ready(function () {
        mostrarmensajes();
        consulta();//---Para que cuando se carge la página se actulice con los datos del dia de hoy.

        //---Funcion que dispara ajax hacia el metodo de un controlador por medio de la ruta.
        function consulta() {
            var form_aula = $('select[name="aula"]').val();
            var form_fecha = $('input[name="fecha"]').val();

            var consultahorario = $.post("ajax", {fecha: form_fecha, aula: form_aula},function(){
               console.log("realizando consulta ajax");
               $('#loading').show();
            });
                    
            consultahorario.done(function (data) {
                var obj = JSON.parse(data); //pasa un string en formato json a un objeto.
                evaluarConsulta(obj);
                console.log('consulta ajax completada');
                $('#loading').delay('100').fadeOut('fast');
            });
        }

        //---Funcion para evaluar lo que devuelve ajax 
        function evaluarConsulta(ajaxdata) {

            resetConsultaAnterior();
            $.each(ajaxdata, function (index, value) { //se le pasa un objeto y recorre sus atributos. index es el nombre del atributo y value el valor.
                console.log(index, value);

                if (value.email === "{{Session::get('USUARIO')->getEmail()}}") { //si el email del usuario que esta en linea coincide con la reserva entiende que esta hecha por el.
                    $('#' + index + ' input[type="checkbox"]').prop("checked", true);
                    $('#' + index + ' .reserva').html(value.nombre);
                    $('#' + index).addClass('seleccionable');
                    $('#' + index).addClass('oldselect');
                    $('#' + index).addClass('seleccionada');
                } else {
                    $('#' + index).removeClass();
                    $('#' + index).removeClass('seleccionable');
                    $('#' + index + ' .reserva').html(value.nombre);
                    $('#' + index).addClass('noseleccionable');
                }
            });
            //enlaza la funcion activar con los li que tengan la clase seleccionable.
            $('.seleccionable').bind('click', activar);
        }

        //Funcion que se enlaza al evento click de los li del horario
        function activar() {
            $('input[type=checkbox]', this).prop('checked', !($('input[type=checkbox]', this).is(':checked'))); //activa o desactiva el checkbox contenido
            $(this).toggleClass('seleccionada'); //Cambia el estilo de seleccionado que pinta el simbolo check
            $('.reserva', this).text(($('.reserva', this).text() === 'Libre' ? "{{Session::get('USUARIO')->getNombre()}}" : 'Libre')); //Cambia el nobmre de libre a usuario.
        }
        //---Funcion para resetear el horario entre consulta y consulta
        function resetConsultaAnterior() {
            $('.seleccionable').unbind('click', activar);
            $('#horariolistado li').removeClass();
            $('#horariolistado li input[type="checkbox"]').prop("checked", false);
            $('#horariolistado li .reserva').text('Libre');
            $('#horariolistado li').addClass('seleccionable');
        }
        
        //--Oculta automaticamente los mensajes que se muestran al usuario.
        function mostrarmensajes(){
            $('.alert').hide().slideDown();
        }
        $(".alert").fadeTo(5000, 500).slideUp(500, function () {
            $(".alert").alert('close');
        });

        //--- Configuración de Bootstrap Datepicker ---//
        $('#datepicker').datepicker({
            format: "yyyy/mm/dd",
            multidate: false,
            daysOfWeekDisabled: "0,6",
            daysOfWeekHighlighted: "0,6",
            language: "es",
            todayHighlight: true,
            startDate: "{{\Carbon\Carbon::now()}}", //Los días anteriores a hoy se deshabilitan
            //endDate: "{{\Carbon\Carbon::parse('next sunday')->toDateString()}}" //Limite de fecha futura para hacer reserva //Se puede cambiar por una variable
            endDate: "{{\Carbon\Carbon::now()->addDays(10)->toDateString()}}"
        });

        //---Elementos del formulario que al cambiar disparan ajax mediante la llamada a la funcion consulta()

        $('select[name="aula"]').change(consulta);
        $('#datepicker').on("changeDate", function () {
            $('#input_fecha_oculto').val(
                    $('#datepicker').datepicker('getFormattedDate')
                    );
            consulta(); //Cuando cambia el datepicker y rellena el valor del input "fecha" entonces se llama a consulta()
        });

        //-- Valida si se ha seleccionado alguna hora antes de hacer el submit del formulario--//
        $('form').submit(function (event) {
            event.preventDefault();
            var checkbox_seleccionado = $("input:checked", '#horario').length > 0;
            var oldreservas = $('#horario .oldselect').length > 0; //si hay reservas viejas que se estan cancelando tiene que dejar aunque no haya checbox seleccionados
            if (checkbox_seleccionado) {
                this.submit(); //metodo nativo que no es de jquery.

            } else if (oldreservas) {

                this.submit();

            } else {
                if ($('#zona_mensajes').html() == "") {
                    $('#zona_mensajes').html('<div class="alert alert-warning" role="alert">Seleccione alguna hora</div>');
                    $(".alert").fadeTo(2000, 500).slideUp(500, function () {
                        $(".alert").alert('close');
                        $('#zona_mensajes').html("");
                    });
                }
            }
        });
    });
    </script>
    @endsection