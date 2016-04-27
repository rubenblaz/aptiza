<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <style type="text/css">
        td{
            border:1px solid black;
        }
    </style>
    <body>
        <table>
            
           <thead>
                 <tr>
                    <th>Cod</th>
                    <th>Nombre</th>
                    <th>Seccion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apartados as $apartado)
                    <tr>
                        <td>{{$apartado->COD}}</td>
                        <td>{{$apartado->NOMBRE}}</td>
                        <td>{{$apartado->SECCION}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
