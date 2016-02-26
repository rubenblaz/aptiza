<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF del informe de alumnos FCT</title>
    {!! Html::style('css/FCT/pdf.css') !!}
</head>
<body>
<main>
    <div id="details" class="clearfix">
        <div id="invoice">
            <img src="img/FCT/cabecera.png" alt="Cabecera" width="100%"/>
            <br>
            {{--<h1>{{ $invoice }}</h1>--}}
            <br>
            <div class="curso">CURSO ACADÉMICO: ________________</div>
            <br/>
            <div class="curso">CICLO FORMATIVO: {!! $curso2 !!}</div>
            <br/>
            <div id="texto">
                Los alumnos/as relacionados a continuación, reciben el día de hoy la información y
                documentación a cumplimentar referida al módulo de Formación en Centros de
                Trabajo que realizarán en el presente curso. Esta incluye el plan de formación, ayudas de
                transporte, exenciones y correspondencia laboral. Asimismo, con la firma del presente
                documento, manifiestan el conocimiento y aceptación de su contenido.
            </div>
            <br>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no"><b>NOMBRE Y APELLIDOS</b></th>
            <th class="desc"><b>FIRMA</b></th>
        </tr>
        </thead>
        <tbody>
        {!! $data['alumnos']!!}
        </tbody>
        <div>
            <center>{!! $date !!}</center>
            <center>El/La Tutor/a de FCT</center>
        </div>
    </table>
</main>
</body>
</html>