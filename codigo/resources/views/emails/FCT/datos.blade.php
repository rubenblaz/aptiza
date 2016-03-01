<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos de acceso</title>
</head>
<body>
    <h2>Siga el siguiente enlace para establecer los datos de acceso</h2>
    <a href="{{URL::route('reestablecepass',['pass'=>$pass,'email'=>$email])}}">Siga este link para reestablecer contraseña</a>
</body>
</html>