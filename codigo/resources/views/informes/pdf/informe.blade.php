
<!DOCTYPE html>
<!-- Plantilla PDF para informes -->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <style type="text/css">
        body{
            font-family: sans-serif;
            font-size: 10pt;
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
        td.asignatura{
           
            width: 35%;
            padding: 5px;
           
        }
        
        .apartado{
            height: 75px;
            text-align: left;
            vertical-align: top;
        }
        .valores{
          width: calc(65%/16);
          background-color: grey;
        }
    </style>
    <body>
        <table>
            <tr>
                <th class='asignatura' rowspan="2">Materia</th>
                @foreach($datos['MODELOINFORME'] as $apartado)
                    @if($apartado['COD'] < 4)
                        <th class='apartado' colspan="{{count($apartado['APARTADOS'][0]['VALORES'])}}">{{$apartado['NOMBRE']}}</th>
                    @endif
                @endforeach
            </tr>
            <tr>
                @foreach($datos['MODELOINFORME'] as $apartado)
                    @if($apartado['COD'] < 4)
                        @foreach($apartado['APARTADOS'][0]['VALORES'] as $key=>$apart)
                            <td class='valores'>{{$key+1}}</td>
                        @endforeach
                    @endif
                @endforeach
            </tr>
            @foreach($datos['ASIGNATURAS'] as $key=>$asignatura)
                <tr>
                    <td class='asignatura' >{{$asignatura}}</td>
                    @foreach($datos['MODELOINFORME'] as $apartado)
                    @if($apartado['COD'] < 4)
                        @foreach($apartado['APARTADOS'][0]['VALORES'] as $key=>$apart)
                        <td class="valores"></td>
                        @endforeach
                    @endif
                @endforeach
                </tr>
            @endforeach
        </table>
    </body>
</html>
