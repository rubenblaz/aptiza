@extends('layouts.plantilla')
@section('customcss')



@endsection
<style>
body{
    background-color:black !important;
    background-image: url('img/background.jpg');
    background-size:cover;
    background-repeat: no-repeat;
}
section{
    background-color: white;
    display:table-cell;
    padding: 20px;
   
}
.titulo{
    border-bottom: solid 1px #215891;
    color:#215891;
    height: 50px;
    margin-bottom: 20px;
    margin-bottom: 50px;
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
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Library</a></li>
                <li class="active">Data</li>
            </ol>
        </div>
        <section class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
            <div class="titulo col-md-10 col-md-offset-2">
                <h3>Inicio</h3>
            </div>
            <div class='row'>
            <article class="articulo col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
               <!--Espacio-->
               <img class='img-responsive'src="img/aptiza_logo_invert.png" alt="" />
            </article>
            <article class="col-md-6 col-sm-6 col-xs-12">
                <h1 class="text-right">Herramienta de gestión para docentes.</h1>
            </article>
            <article class="articulo col-md-6 col-sm-6 col-xs-12 col-sm-offset-0 col-md-offset-0 col-xs-offset-0">
                <img class=''src="img/ilus_llave.svg" alt="" />
            </article>
            <article class="articulo col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h4>{!!Session::has('USUARIO')?"Bienvenido <span class='label label-primary'>".Session::get('USUARIO')->getNombre()."</span>":""!!}</h4>
                    <h4 class='text-right'>Realice las tareas de supervisión, coordinación, y generación de informes entre otras, de la manera más sencilla.
                        Y concentrese en lo más importante...</h4>
                <div class="col-md-10 col-md-offset-1"><h2>"...formar a las generaciones del futuro."</h2></div>
            </article>
                <article class="articulo articulo-fondo col-lg-6 col-md-6 col-md-offset-2 col-sm-6 col-xs-10 col-sm-offset-0 col-md-offset-0 col-xs-offset-2">
                    <ul>
                        <li>
                            <h3>Alumnos</h3>
                        </li>
                        <li>
                            <h3>Profesores</h3>
                        </li>
                        <li>
                            <h3>Tutores</h3>
                        </li>
                        <li>
                            <h3>Padres</h3>
                        </li>
                    </ul>
            </article>
            </div>
        </section>
    </div>
</div>
@endsection
