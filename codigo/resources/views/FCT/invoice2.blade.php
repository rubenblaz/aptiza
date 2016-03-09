<!DOCTYPE html>
<html>
<head>
    <title>Memoria final - PDF</title>
    {!! Html::style('css/FCT/pdf2.css') !!}
</head>
<body>
<main>
    <p><b>Tutor: </b> {!! $datosv['nombre_tutor'] !!}</p>
    <p><b>Grupo: </b> {!! $datosv['nombre_grupo'] !!}</p>
    <p><b>Curso académico: </b> {!! $datosv['curso_academico'] !!}</p>
    <table>
        <thead>
        <tr>
            <th>Alumno</th>
            <th>Empresa</th>
            <th>Convenio</th>
            <th>Tfno. Móvil</th>
            <th>Tfno. Fijo</th>
            <th>Email</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>¿Apto?</th>
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