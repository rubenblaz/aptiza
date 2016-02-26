<?php namespace Collective\Html;
use Html;
use Form;
use Session;
?>
@extends('Layouts.layout')
@section('contenido')
    <ol class="breadcrumb">
        <li>{{ HTML::link('/', 'Inicio') }}</li>
        <li class="active">Mi cuenta</li>
    </ol>
    <br>
    {!! Form::open(array('action' => 'FCT/Admin/otros@admincuenta2')) !!}
    @if(isset($mensaje))
        @if($mensaje == "Correcto")
            <div class="alert alert-success alert-dismissable fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Cambio de contraseña realizado correctamente.
            </div>
        @else
            <div class="alert alert-danger alert-dismissable fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Error al cambiar la contraseña, compruebe los datos introducidos.
            </div>
        @endif
    @endif
    <center><p><b>Modificar datos de mi cuenta:</b></p></center>
    <div class="form-group">
        {!! Form::label('Contraseña actual') !!}
        {!! Form::password('passactual', array('required', 'class'=>'form-control', 'title'=>'Contraseña actual')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Nueva contraseña') !!}
        {!! Form::password('passnueva', array('required', 'class'=>'form-control', 'title'=>'Contraseña nueva')) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Repetir contraseña nueva') !!}
        {!! Form::password('passnueva2',array('required', 'class'=>'form-control', 'title'=>'Repetir contraseña nueva')) !!}
    </div>
    <center>{!! Form::submit('Cambiar',array('class'=>'btn btn-success', 'title'=>'Cambiar')) !!}</center>
    {!! Form::close() !!}
@endsection


