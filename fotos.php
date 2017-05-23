<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fotos</title>
    <link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon">

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Mi CSS -->
    <link href="./styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Contenedor -->
    <div class="container-fluid">
        <!--Incluye el archivo conexion.inc-->
        <?php
        include "conexion.inc";
        ?>
        <!-- Menú -->
        <?php
        if (isset($_COOKIE["usuario"]) || isset($_COOKIE["moderador"])){
            include "menuLoged.inc";
        } else {
            include "menu.inc";
        }
        ?>
        <!--Empieza la página de fotos-->
        <div class="contenido">
            <div class="row"><!-- Primera fila de imágenes -->
                <div class="col-sm-4"><!-- Izq -->
                    <a href="./imagenes/ajedrez.png"><img src="./imagenes/ajedrez.png"/></a>
                </div>
                <div class="col-sm-4"><!-- Medio -->
                    <a href="./imagenes/logox6_positivo.png"><img src="./imagenes/logox6_positivo.png"/></a>
                </div>
                <div class="col-sm-4"><!-- Drch -->
                    <a href="./imagenes/logox6-2.png"><img src="./imagenes/logox6-2.png"/></a>
                </div>
            </div>
            <div class="row"><!-- Segunda fila de imágenes -->
                <div class="col-sm-4"><!-- Izq -->
                    <a href="./imagenes/ajedrez2.png"><img src="./imagenes/ajedrez2.png"/></a>
                </div>
                <div class="col-sm-4"><!-- Medio -->
                    <a href="./imagenes/ajedrez3.png"><img src="./imagenes/ajedrez3.png"/></a>
                </div>
                <div class="col-sm-4"><!-- Drch -->
                    <a href="./imagenes/logox6_negativo.png"><img src="./imagenes/logox6_negativo.png"/></a>
                </div>
            </div>
        </div>
        <!-- Pié de página -->
        <?php
        include "pie.inc";
        ?>
    </div>
</body>
</html>