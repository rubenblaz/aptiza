@extends('layouts.plantilla')
@section('customcss')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <style type="text/css">
        body {
            background-color: #269abc;
        }
    </style>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
@stop
@section('migas')
    <li>{{ Html::link('inicio', 'Inicio') }}</li>
    <li class="active">Alta empresas</li>
@stop
@section('titulo')
    Alta de empresas
@stop
@section('contenido')
    <div class="row">
        <div class="col-md-12" style="margin-left: auto; margin-top: auto;">
            <div class="panel panel-default" id="panelalta">
                <div class="panel panel-primary">
                    <!--<div class="panel-heading">
                        <h4 class="panel-title">Dar de alta una empresa:</h4>
                    </div>-->
                    <div class="panel-body">
                        {!! Form::open(array('action' => 'fct\usuarios@alta')) !!}
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('CIF') !!}
                                {!! Form::text('cif',null,array('placeholder'=>'000000000X','required', 'class'=>'form-control', 'title'=>'CIF')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Nombre') !!}
                                {!! Form::text('nombre',null,array('placeholder'=>'Dynos Informática','required','class'=>'form-control', 'title'=>'Nombre')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Código Postal') !!}
                                {!! Form::text('cp',null,array('placeholder'=>'13000','required','class'=>'form-control', 'title'=>'Codigo postal')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Teléfono') !!}
                                {!! Form::text('telefono',null,array('placeholder'=>'926213456','required','class'=>'form-control', 'title'=>'Telefono')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Dni Representante') !!}
                                {!! Form::text('dnirep',null,array('placeholder'=>'12124578X','required','class'=>'form-control', 'title'=>'Dni representante')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Email') !!}
                                {!! Form::text('usuario',null,array('placeholder'=>'ejemplo@ejemplo.com','required', 'class'=>'form-control', 'title'=>'Usuario', 'type'=>'email')) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Convenio') !!}
                                {!! Form::text('convenio',null,array('placeholder'=>'000000000','required','class'=>'form-control', 'title'=>'Convenio')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Alias') !!}
                                {!! Form::text('alias',null,array('placeholder'=>'Dynos','required','class'=>'form-control', 'title'=>'Alias')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Población') !!}
                                {!! Form::text('poblacion',null,array('placeholder'=>'Villarrubia de los ojos','required','class'=>'form-control', 'title'=>'Poblacion')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Fax') !!}
                                {!! Form::text('fax',null,array('placeholder'=>'0998 455879','required','class'=>'form-control', 'title'=>'Fax')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Observaciones') !!}
                                {!! Form::text('observaciones',null,array('placeholder'=>'Observaciones.','required','class'=>'form-control', 'title'=>'Observaciones')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Contraseña') !!}
                                {!! Form::password('password',array('placeholder'=>'*********','required', 'class'=>'form-control', 'title'=>'Contraseña')) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Fecha de convenio') !!}
                                <input type="text" id="fecha" name="fechaconvenio" value=""
                                       placeholder="dd/mm/yyyy"
                                       class="form-control" title="Fecha de convenio"/>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Dirección') !!}
                                {!! Form::text('direccion',null,array('placeholder'=>'Calatrava, 34.','required','class'=>'form-control', 'title'=>'Direccion')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Provincia') !!}
                                {!! Form::text('provincia',null,array('placeholder'=>'Ciudad Real','required','class'=>'form-control', 'title'=>'Provincia')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Convenio Representante') !!}
                                {!! Form::text('convrep',null,array('placeholder'=>'0000000000','required','class'=>'form-control', 'title'=>'Convenio representante')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Tipo de empresa') !!}
                                {!! Form::text('tipoempresa',null,array('placeholder'=>'Privada','required','class'=>'form-control', 'title'=>'Tipo de empresa')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Favorita') !!}
                                {!! Form::select('favorita', array('SI' => 'SI', 'NO' => 'NO'), 'SI', array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        @if(Session::has('mensajealta'))
                            @if(Session::get('mensajealta') == "error")
                                <div class="alert alert-danger alert-dismissable fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    Error al insertar la empresa, ya existe.
                                </div>
                            @else
                                <div class="alert alert-success alert-dismissable fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    Empresa insertada correctamente.
                                </div>
                            @endif
                        @endif
                        <center>{!! Form::submit('Crear empresa',array('class'=>'btn btn-success', 'title'=>'Crear empresa')) !!}</center>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#fecha").datepicker();
        });
    </script>
    <script type="text/javascript" language="javascript">
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $(function () {
            $("#fecha").datepicker();
        });
    </script>
@stop