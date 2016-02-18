<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body>
        <h1>Recuperación de contraseña de usuario</h1>
        <p>Siga este link para reestablecer la contraseña de su usuario.</p>
        <p>{!!URL::route('reestablecepass',['pass' => $pass, 'email' => $email])!!}</p>
    </body>
</html>