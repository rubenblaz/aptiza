<!DOCTYPE html>
<html>
<head>
    <title>Memoria final - PDF</title>
    {!! Html::style('css/FCT/pdf2.css') !!}
</head>
<body>
<main>
    <table>
        <thead>
        <tr>
            <th>Alumno</th>
            <th>Empresa</th>
            <th>Convenio</th>
            <th>Tfno M</th>
            <th>Tfno F</th>
            <th>Email</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Apto</th>
        </tr>
        </thead>
        @foreach($alumnos as $al)
            <tr>
                <td>{!! $al['nombre_apellidos_alumnos'] !!}</td>
                <td>{!! $al['nombre_empresas'] !!}</td>
                <td>{!! $al['convenios'] !!}</td>
                <td>{!! $al['telefonos_m'] !!}</td>
                <td>{!! $al['telefonos_f'] !!}</td>
                <td>{!! $al['emails'] !!}</td>
                <td>{!! $al['fechas_inicio'] !!}</td>
                <td>{!! $al['fechas_fin'] !!}</td>
                <td>{!! $al['aptos'] !!}</td>
            </tr>
        @endforeach
    </table>
</main>
</body>
</html>