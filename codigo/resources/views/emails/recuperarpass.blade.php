<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body>
        <h1>Recuperación de contraseña de usuario</h1>
        
         <a href="{{URL::route('/solicitaPass/nuevoPassEmail',['pass'=>$pass,'email'=>$email])}}">Siga este link para reestablecer contraseña</a>
    </body>
</html>