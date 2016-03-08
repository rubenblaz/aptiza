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
    <li class="active">Modificación de empresas</li>
@stop
@section('titulo')
    Modificación de empresas
@stop
@section('contenido')
    <div class="row">
        <div class="col-md-12" style="margin-left: auto; margin-top: auto;">
            <div class="panel panel-default" id="panelalta">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        {!! Form::open(array('action' => 'FCT\Admin\otros@modempresas_submit')) !!}
                        @foreach($empresa_modificar as $emp)
                            <input type="hidden" value="{!! $emp->EMAIL !!}" name="usuario_original"/>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('CIF') !!}
                                    {!! Form::text('cif',$emp->CIF,array('required', 'class'=>'form-control', 'title'=>'CIF')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Nombre') !!}
                                    {!! Form::text('nombre',$emp->NOMBRE,array('required','class'=>'form-control', 'title'=>'Nombre')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Código Postal') !!}
                                    {!! Form::text('cp',$emp->CP,array('required','class'=>'form-control', 'title'=>'Codigo postal')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Teléfono') !!}
                                    {!! Form::text('telefono',$emp->TELEFONO,array('required','class'=>'form-control', 'title'=>'Telefono')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Dni Representante') !!}
                                    {!! Form::text('dnirep',$emp->DNI_REPRESENTANTE,array('required','class'=>'form-control', 'title'=>'Dni representante')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Email') !!}
                                    {!! Form::text('usuario',$emp->EMAIL,array('required', 'class'=>'form-control', 'title'=>'Usuario', 'type'=>'email')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('Convenio') !!}
                                    {!! Form::text('convenio',$emp->CONVENIO,array('required','class'=>'form-control', 'title'=>'Convenio')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Alias') !!}
                                    {!! Form::text('alias',$emp->ALIAS,array('required','class'=>'form-control', 'title'=>'Alias')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Población') !!}
                                    {!! Form::text('poblacion',$emp->POBLACION,array('required','class'=>'form-control', 'title'=>'Poblacion')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Fax') !!}
                                    {!! Form::text('fax',$emp->FAX,array('required','class'=>'form-control', 'title'=>'Fax')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Observaciones') !!}
                                    {!! Form::text('observaciones',$emp->OBSERVACIONES,array('required','class'=>'form-control', 'title'=>'Observaciones')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Contraseña') !!}
                                    {!! Form::password('password',array('placeholder'=>'**********','disabled', 'class'=>'form-control', 'title'=>'Contraseña')) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('Fecha de convenio') !!}
                                    <input type="text" id="fecha" name="fechaconvenio" value="{!! $emp->FECHA_DE_CONVENIO !!}"
                                           placeholder="dd/mm/yyyy"
                                           class="form-control" title="Fecha de convenio"/>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Dirección') !!}
                                    {!! Form::text('direccion',$emp->DIRECCION,array('required','class'=>'form-control', 'title'=>'Direccion')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Provincia') !!}
                                    {!! Form::text('provincia',$emp->PROVINCIA,array('required','class'=>'form-control', 'title'=>'Provincia')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Convenio Representante') !!}
                                    {!! Form::text('convrep',$emp->CONVENIO_REPRESENTANTE,array('required','class'=>'form-control', 'title'=>'Convenio representante')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Tipo de empresa') !!}
                                    {!! Form::text('tipoempresa',$emp->TIPO,array('required','class'=>'form-control', 'title'=>'Tipo de empresa')) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Favorita') !!}
                                    {!! Form::select('favorita', array('SI' => 'SI', 'NO' => 'NO'), $emp->FAVORITA, array('class'=>'form-control')) !!}
                                </div>
                            </div>
                        @endforeach
                        <center>{!! Form::submit('Modificar empresa',array('class'=>'btn btn-success', 'title'=>'Modificar empresa')) !!}</center>
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