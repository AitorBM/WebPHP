<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto</title>
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
        <!-- Empieza la página de contacto -->
        <div class="contenido">
        <div class="row"><!-- Tercer párrafo -->
            <div class="col-sm-12">
                <h3>Contacto</h3>
                <p>aitor.bringas@ikasle.egibide.org</p>
            </div>
        </div><!-- /Tercer párrafo -->
        </div>
        <!-- Pié de página -->
        <?php
        include "pie.inc";
        ?>
    </div>
</body>
</html>