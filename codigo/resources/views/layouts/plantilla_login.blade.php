<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" />

        <title>Aptiza</title>

        <!-- Fuentes -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <!-- Estilos -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="" />
        <style type="text/css">
            html body{
                background-color: #eeeeee;
/*                background-color: #F2CF3D;*/
background-image: url('img/background_color.jpg');
    background-size:cover;
    background-repeat: no-repeat;
            }
            .logo{
/*               background-color: white ;*/
    
                margin-bottom: 30px;
            }
            h1{
                color:#F2CF3D;
                font-size: 1.5em;
            }
            .panel-heading{
                background-color: #215891 !important;
                border-bottom: #F2CF3D solid 3px !important;
            }
        </style>
    </head>
    <body>
        <div class="logo row">
            <div class="col-sm-8 col-sm-offset-2">
                {{Html::image('img/logo_aptiza.svg')}}
                <!--<img src="img/logo_aptiza.svg" alt="" />-->
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3">
                   @yield('contenido')
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
