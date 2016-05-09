
<!DOCTYPE html>
<!-- Plantilla PDF para informes -->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <style type="text/css">
        html{
            margin:0;
        }
        body{
            font-family: sans-serif;
            font-size: 9pt;
            margin: 18mm 18mm 18mm 18mm;
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
            margin-bottom: 9mm;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            
        }
        .cabecera_alumno tr:first-child td{
            border:solid 1px black;
            vertical-align: middle;
            height: 12mm;
            padding-left: 2mm;
        }
        .cabecera_alumno tr:nth-child(2) td{
            text-align: center;
            border:1px solid black;
        }
        .cabecera_alumno tr:nth-child(2) td:first-child{
            border:0px solid black;
            background-color:white;
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
        .lista_competencias{
            display: block;
            margin: 0 auto;
        }
        .lista_competencias li{
            display: inline;
        }
        .titulo_secc_valor{
           padding:0px;
           margin: 0px;
        }
        .list_secc_valor ul{
            list-style: none;
            padding-left: 15px;
            text-height:text-size;
            margin:2mm;
            font-size: 7pt;
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
    <body>
        <table class='estadillo cabecera'>
            <tr>
                <td rowspan="2">
                    I.E.S. FRAY ANDRES PUERTOLLANO
                </td>
                <td colspan="3">
                    INFORME DE EVALUACIÓN<br>Curso:Primero E.S.O.
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
                <td style="width:10%">ALUMNO/A</td>
                <td style="width:52%" colspan="5">Ernesto Ruiz Moya</td>
                <td style="width:18%" colspan="2">GRUPO</td>
                <td style="width:18%" colspan="2">1ºA</td>
            </tr>
            <tr>
                <td style="width:100%" colspan="2"></td><!--???-->
                <td style="width:25%" >Evaluación</td>
                <td style="width:1%">1º</td>
                <td style="width:1%"></td>
                <td style="width:2%">2º</td>
                <td style="width:1%"></td>
                <td style="width:3%" colspan="2">3º/final</td>
                <td style="width:1%"></td>
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
            <p class='titulo_secc_valor'>Grado de consecución de objetivos y contenidos atendiendo a los criterios de evaluación del plan de Trabajo Individualizado con Adaptación Curricular para Alumnos con Necesidades Específicas de Apoyo Educativo.</p>
            @else
            <p class='titulo_secc_valor'>{{$seccion->NOMBRE}}</p>
            @endif
            <ul>
                @foreach($seccion->APARTADOS[0]->VALORES as $key=>$valor)
                <li>{{($key+1).'. '.$valor->NOMBRE}}</li>
                @endforeach
            </ul>
            @endif
            @endforeach
        </div>
        <p>Si necesita más informaicón puede solicitarla al tutor/a, dpto de orientaicón y jefatura de estudios.</p>
        <p style="margin-left: 50mm">Puertollano, ____ de _____________ de 20 ____</p>
        <p style="margin-left: 80mm">El tutor/a:</p>
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
        <hr><!-- Salto de página -->
        
         <table class='estadillo cabecera'>
            <tr>
                <td rowspan="2">
                    I.E.S. FRAY ANDRES PUERTOLLANO
                </td>
                <td colspan="3">
                    INFORME DE EVALUACIÓN<br>PLAN DE TRABAJO INDIVIDUALIZADO<br>Curso:Primero E.S.O.
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
        <p>Las competencias básicas se han trabajado en cada un a de las materias cursadas por el alumno y el nivel de adquisición alcanzado ha sido:</p>
        <ul class='lista_competencias'>
            @foreach($modeloinforme[3]->APARTADOS[0]->VALORES as $key=>$valor)
            <li><b>{{$key+1}}</b>:{{$valor->NOMBRE}}</li>
            @endforeach
        </ul>
        
    </body>
</html>
