<!DOCTYPE html>
<html>
<head>
    <title>Memoria final - PDF</title>
    {!! Html::style('css/FCT/pdf2.css') !!}
</head>
<body>
<main>
    @foreach($alumnos as $al)
        <p>{!! $al['nombre_empresas'] !!}</p>
    @endforeach
</main>
</body>
</html>