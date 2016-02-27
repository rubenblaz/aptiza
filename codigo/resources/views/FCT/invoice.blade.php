<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF del informe de alumnos FCT</title>
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