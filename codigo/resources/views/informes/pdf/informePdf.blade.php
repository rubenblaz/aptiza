
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
            font-size: 10pt;
            margin: 10mm 20mm 10mm 20mm;
        }
        td{
            border:1px solid black;
        }
        th{
            border: 1px solid black;
        }
        
        table{
            width: 100%;
            border-collapse: collapse;
            border: solid 1px black;
            table-layout: fixed;
        }
        td.materia{
            width: 35%;
            padding: 5px;
           
        }
        td.asignatura{
            width: 30%;
            padding: 5px;
        }
        .apartado{
            height: 75px;
            text-align: left;
            vertical-align: top;
        }
        .valores{
          width: calc(65%/{{count($modeloinforme[0]->APARTADOS)+count($modeloinforme[1]->APARTADOS)+count($modeloinforme[2]->APARTADOS)}});
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
        .tic{
            background-color: red;
        }
        hr{
            page-break-after:always;
            border:0;
            margin:0;
            padding:0;
        }
        
    </style>
    <body>
        <table>
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
                                <td class="valores {{($calificacion->esIgualValor($asignatura->COD,$apartado->COD,$valor->COD))?'tic':''}}"></td>
                            @endforeach
                        @endforeach
                    @endif
                @endforeach
                </tr>
            @endforeach
        </table>
        <hr>
        <table>
            <tr>
               
                
                <th class='asignatura' colspan="2" rowspan="2">Asignaturas</th>
                <th colspan="{{count($modeloinforme[3]->APARTADOS)+1}}">Competencias</th>
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
                                <td class="valores {{'comp'.$calificacion->getValor($asignatura->COD,$apartado->COD)}}">{{substr($calificacion->getValorNombre($asignatura->COD,$apartado->COD),0,4)}}</td>
                        @endforeach
                        <td></td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
