
<!DOCTYPE html>
<!-- Plantilla PDF para informes -->
<html>
    <head>
        <title>{{$calificacion->getAlumno()->getNomCompleto()}}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />

    <style type="text/css">
        html{
            margin:0;
        }
        body{
            font-family: sans-serif;
            font-size: 9pt;
            margin: 18mm 18mm 10mm 18mm;
        }
        .cabecera{ 
            margin-bottom:5mm
        }
        .cabecera td{
            text-align: center;
            vertical-align: middle;
        }
        .cabecera td{
            font-size: 6.5pt;
            font-family: serif;
            margin: 0px;
            padding: 0px;
        }
        .cabecera tr:nth-child(1) td:nth-child(2){
            height: 20mm;
            width: 60.2%;

            font-family: sans-serif;
            font-weight: bolder;
            font-size: 12pt;
        }
        .cabecera tr:nth-child(1) td:nth-child(3){
            width:22.8%;
            vertical-align: bottom;
            background-image: url("{{ URL::asset('img/informepdf/logo_junta_educacion.jpg')}}");
            background-repeat: no-repeat;
        }
        .cabecera tr:nth-child(2) td{
            padding: 0px;
            font-size: 8pt;
            height: 5mm;
            font-family: sans-serif;
        }
        .cabecera_alumno{
            font-size: 10pt;
            margin-bottom: 9mm;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .cabecera_alumno td{
            border:1px solid black;
        }
        .cabecera_alumno tr:first-child td{
            vertical-align: middle;
            height: 12mm;
            padding-left: 1mm;
        }
        .cabecera_alumno tr:nth-child(2) td{
            text-align: center; 
        }
        .estadillo{
            width: 100%;
            border-collapse: collapse;
            border: solid 1px black;
            table-layout: fixed;
            margin-bottom: 5mm;

        }
        .estadillo td{
            border:1px solid black;
        }
        .estadillo th{
            border: 1px solid black;
            font-size: 6pt;
            font-weight: normal;
        }

        td.materia{
            width: 30%;
            padding: 0px;
            padding-left: 5px;
        }
        td.asignatura{
            width: 30%;
            padding: 2px;
        }
        .apartado{
            height: 13mm;
            text-align: left;
            vertical-align: top;
        }
        .valores{
            width: calc(70%/{{count($modeloinforme[0]->APARTADOS)+count($modeloinforme[1]->APARTADOS)+count($modeloinforme[2]->APARTADOS)}});
            text-align: center;
        }
        .competencia{
            padding-left: 5px;
            height: 175px;
            width: calc(50%/{{count($modeloinforme[3]->APARTADOS)}};
            padding-bottom: 0px;
        }
        .observaciones{
            width: 20%;
        }
        .vertical-text{
            font-size: 9pt;
            font-weight: lighter;
            text-align: left;
            transform: rotate(-90deg);
            transform-origin: 45px;
            line-height:10pt; 
            width: 150px;
        }
        .aviso{
            border:1px solid black;
            padding-left:2mm;
            margin-bottom: 4mm;
        }
        .lista_competencias {
            text-align: center;
        }
        .lista_competencias li{
            display: inline;
        }
        .list_secc_valor{
            font-size: 8pt;
        }
        .list_secc_valor p{
            padding:0px;
            margin: 0px;
            font-weight: bolder;
        }
        .list_secc_valor ul{
            list-style: none;
            padding-left: 15px;
            text-height:text-size;
            margin:2mm;
        }
        .list_secc_valor ul:nth-child(2) li{
            display:inline;
            margin-right: 5px;  
        }
        hr{
            page-break-after:always;
            border:0;
            margin:0;
            padding:0;
        }

    </style>

</head>
    <body>
        <table class='estadillo cabecera'>
            <tr>
                <td rowspan="2">
                    I.E.S. FRAY ANDRES PUERTOLLANO
                </td>
                <td colspan="3">
                    INFORME DE EVALUACIÓN<br>Curso:Curso:{{$calificacion->getGrupo()->getCurso()}}
                </td>
                <td rowspan='2'>
                    Consejería de Educación y Ciencia
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Página 1 de 2</td>
            </tr>
        </table>
        <table class="cabecera_alumno">
            <tr>
                <td style="width:19%">ALUMNO/A</td>
                <td style="width:56%" colspan="5">{{$calificacion->getAlumno()->getNomCompleto()}}</td>
                <td style="width:9%" colspan="2">GRUPO</td>
                <td style="width:15%" colspan="2">{{$calificacion->getGrupo()->getNombre()}}</td>
            </tr>
            <tr>
                <td style="width:19%;border:0px"></td> 
                <td style="width:41%;border:0px"></td> 
                <td style="width:15%" >Evaluación</td>
                <td style="width:0%">1º</td>
                <td style="width:0%">{{($calificacion->getEval() == 1)?'X':''}}</td>
                <td style="width:0%">2º</td>
                <td style="width:7%">{{($calificacion->getEval() == 2)?'X':''}}</td>
                <td style="width:10%" colspan="2">3º/final</td>
                <td style="width:7%">{{($calificacion->getEval() == 3)?'X':''}}</td>
            </tr>
        </table>
        <table class="estadillo">
            <tr>
                <th class='materia' rowspan="2">Materia</th>
                @foreach($modeloinforme as $seccion)
                @if($seccion->COD < 4)
                <th class='apartado' colspan="{{count($seccion->APARTADOS[0]->VALORES)}}">{{$seccion->NOMBRE}}</th>
                @endif
                @endforeach
            </tr>
            <tr>
                @foreach($modeloinforme as $seccion)
                @if($seccion->COD < 4)
                @foreach($seccion->APARTADOS[0]->VALORES as $key=>$apart)
                <td class='valores'>{{$key+1}}</td>
                @endforeach
                @endif
                @endforeach
            </tr>
            @foreach($asignaturas as $asignatura)
            <tr>
                <td class='materia' >{{$asignatura->NOMBRE}}</td>
                @foreach($modeloinforme as $seccion)
                @if($seccion->COD < 4)
                @foreach($seccion->APARTADOS as $apartado)
                @foreach($apartado->VALORES as $valor)
                <td class="valores"> {{($calificacion->esIgualValor($asignatura->COD,$apartado->COD,$valor->COD))?'X':''}}</td>
                @endforeach
                @endforeach
                @endif
                @endforeach
            </tr>
            @endforeach
        </table>

        <div class="aviso">Los objetivos, contenidos, criterios de evaluación y calificación trimestrales corresponden a la información facilitada a los padres o tutores legales por el tutor del grupo en la reunión inicial del curso.</div>


        <div class="list_secc_valor">
            @foreach($modeloinforme as $seccion)
            @if($seccion->COD < 4)
            @if($seccion->COD == 2)
            <p>Grado de consecución de objetivos y contenidos atendiendo a los criterios de evaluación del plan de Trabajo Individualizado con Adaptación Curricular para Alumnos con Necesidades Específicas de Apoyo Educativo.</p>
            @else
            <p>{{$seccion->NOMBRE}}</p>
            @endif
            <ul>
                @foreach($seccion->APARTADOS[0]->VALORES as $key=>$valor)
                <li>{{($key+1).'. '.$valor->NOMBRE}}</li>
                @endforeach
            </ul>
            @endif
            @endforeach
        </div>
       <div style="position:fixed;left:18mm;bottom:65mm;width:176mm">
            <p>Si necesita más informaicón puede solicitarla al tutor/a, dpto de orientaicón y jefatura de estudios.</p>
            <p style="margin-left: 50mm">Puertollano, ____ de _____________ de 20 ____</p>
            <p style="margin-left: 80mm;margin-bottom:3mm">El tutor/a:</p>
            <p style="text-align:center">(Cotar y entregar al tutor/a el enterado del informe de evaluación trimestral)</p>
            
            <table style="width:100%;border-top:1px dotted black">
                <tr>
                    <th style="width: 20%;padding-top:2mm">ALUMNO/A</th>
                    <th colspan="2" style="border-bottom:1px solid black;width:80%"></th>
                </tr>
                <tr>
                    <td style='padding-top:3mm'>Padre /madre o tutor/a</td>
                    <td></td>
                    <td style='padding-top:3mm'>Fecha:.......</td>
                </tr>
            </table>
        </div>
        <hr><!-- Salto de página -->

        <table class='estadillo cabecera'>
            <tr>
                <td rowspan="2">
                    I.E.S. FRAY ANDRES PUERTOLLANO
                </td>
                <td colspan="3">
                    INFORME DE EVALUACIÓN<br>PLAN DE TRABAJO INDIVIDUALIZADO<br>Curso:{{$calificacion->getGrupo()->getCurso()}}
                </td>
                <td rowspan='2'>
                    Consejería de Educación y Ciencia
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Página 2 de 2</td>
            </tr>
        </table>

        <table class="cabecera_alumno">
            <tr>
                <td style="width:19%">ALUMNO/A</td>
                <td style="width:56%" colspan="5">{{$calificacion->getAlumno()->getNomCompleto()}}</td>
                <td style="width:9%" colspan="2">GRUPO</td>
                <td style="width:15%" colspan="2">{{$calificacion->getGrupo()->getNombre()}}</td>
            </tr>
            <tr>
                <td style="width:19%;border:0px"></td> 
                <td style="width:41%;border:0px"></td> 
                <td style="width:15%" >Evaluación</td>
                <td style="width:0%">1º</td>
                <td style="width:0%">{{($calificacion->getEval() == 1)?'X':''}}</td>
                <td style="width:0%">2º</td>
                <td style="width:7%">{{($calificacion->getEval() == 2)?'X':''}}</td>
                <td style="width:10%" colspan="2">3º/final</td>
                <td style="width:7%">{{($calificacion->getEval() == 3)?'X':''}}</td>
            </tr>
        </table>

        <table class="estadillo">
            <tr>
                <th class='asignatura' colspan="2" rowspan="2">ASIGNATURAS</th>
                <th colspan="{{count($modeloinforme[3]->APARTADOS)+1}}">{{$modeloinforme[3]->NOMBRE}}</th>
            </tr>
            <tr>      
                @foreach($modeloinforme[3]->APARTADOS as $key=>$apartado)
                <td class='competencia' colspan=""><div class="vertical-text">{{($key+1).'.'.$apartado->NOMBRE}}</div></td>
                @endforeach
                <td class='observaciones'><div class="">Observaciones</div></td>
            </tr>
            <tr>
                <td rowspan="8"></td>
            </tr>
            @foreach($asignaturas as $asignatura)
            <tr>
                <td class='asignatura' >{{$asignatura->NOMBRE}}</td>      
                @foreach($modeloinforme[3]->APARTADOS as $apartado)
                <td class="valores {{'comp'.$calificacion->getValor($asignatura->COD,$apartado->COD)}}">
                    @foreach($apartado->VALORES as $key=>$valor)
                    @if($valor->COD == $calificacion->getValor($asignatura->COD,$apartado->COD))
                    {{$key+1}}
                    @endif
                    @endforeach
                </td>
                @endforeach
                <td></td>
            </tr>
            @endforeach
        </table>

        <p style="font-size:7pt">Las competencias básicas se han trabajado en cada un a de las materias cursadas por el alumno y el nivel de adquisición alcanzado ha sido:</p>

        <ul class='lista_competencias'>
            @foreach($modeloinforme[3]->APARTADOS[0]->VALORES as $key=>$valor)
            <li><b>{{$key+1}}</b>: {{$valor->NOMBRE}}</li>
            @endforeach
        </ul>

        <p style="font-size:7pt">"Competencia básica es el conjunto de conocimientos, destrezas y actutitudes necesarias para la realización y el desarrollo personal"(LOE).<br>
            "Es un cojunto multifuncional y transferible de conocimientos, destrezas y actitudes que todos los individuos necesitan para surealización y desarrollo personal, inclusión y empleo"(Unión Europea)</p>

        <p style="border-top: 1px solid black;font-weight:bolder;margin-bottom: 20mm">OBSERVACIONES</p>
    </body>
</html>
