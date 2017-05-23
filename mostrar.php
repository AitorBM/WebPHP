<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
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
        <!--Empieza la página de mostrar-->
        <div class="contenido">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    // Borrado, si es que nos pasan un id y es moderador
                    if (isset($_GET['id']) && isset($_COOKIE[moderador])) {
                        // Borramos los comentarios correspondientes a la entrada
                        $q = "delete from comentario where entrada_id='" . $_GET['id'] . "'";
                        // Ejecutar la consulta en la conexión abierta. No hay "resultset"
                        mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                        // Formar la consulta (borrado de una fila)
                        $q = "delete from entrada where id='" . $_GET['id'] . "'";

                        // Ejecutar la consulta en la conexión abierta. No hay "resultset"
                        mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                        // Comprobar si hemos afectado a alguna fila
                        echo "<p class='red'>";

                        if (mysqli_affected_rows($conexion) > 0)
                            echo "Se ha borrado la entrada con ID " . $_GET['id'] . ".";
                        else
                            echo "No se ha borrado ninguna entrada.";

                        echo "</p>";
                    }

                    // Formar la consulta (seleccionando todas las filas)
                    $q = "select * from entrada";

                    // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
                    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                    // Calcular el número de filas y mostrarlo
                    $total = mysqli_num_rows($r);
                    echo "<p>Total de filas: $total</p>
                      <hr/>
                      ";

                    $tamañoPagina = 5;
                    $pagina = $_GET['pagina'];
                    if (!$pagina){
                        $inicio = 0;
                        $pagina = 1;
                    } else {
                        $inicio = ($pagina - 1) * $tamañoPagina;
                    }
                    $totalpaginas = $total / $tamañoPagina;

                    $q = "select * from entrada order by fecha desc LIMIT ".$inicio.",".$tamañoPagina." ";
                    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                    // Mostrar el contenido de las filas
                    if ($total > 0) {
                        while ($fila = mysqli_fetch_assoc($r)) {
                            if (isset($_COOKIE["moderador"])){
                                echo "
                                <form action='mostrar.php?pagina' method='get'>
                                    <label for='borrar'>Eliminar entrada nº</label>
                                    <input type='submit' id='borrar' name='id' value='" . $fila['id'] . "'/>
                                </form>";
                            }
                            echo "<a class='entrada' href='detalle.php?id=" . $fila['id'] . "'>
                                <strong>" . $fila['titulo'] . "</strong>
                              <p>Texto: " . $fila['texto'] . "</p>
                              <p>Fecha: " . $fila['fecha'] . "</p>
                              </a>
                              <hr/>
                              ";
                        }
                    }

                    if ($totalpaginas > 1){
                        if ($pagina != 1){
                            $pagina -= 1;
                            echo "
                                <ul class=\"pagination\">
                                    <li><a href=\"mostrar.php?pagina=$pagina\">&laquo;</a></li>
                                </ul>
                            ";
                            $pagina += 1;
                        }
                        for ($i=1; $i<=$totalpaginas; $i++){
                            if ($pagina == $i){
                                echo "
                                    <ul class=\"pagination\">
                                        <li><a>$pagina</a></li>
                                    </ul>
                                ";
                            } else {
                                echo "
                                    <ul class=\"pagination\">
                                        <li><a href=\"mostrar.php?pagina=$i\">$i</a></li>
                                    </ul>";
                            }
                        }
                        if ($pagina != $totalpaginas){
                            $pagina += 1;
                            echo "
                                <ul class=\"pagination\">
                                    <li><a href=\"mostrar.php?pagina=$pagina\">&raquo;</a></li>
                                </ul>
                            ";
                            $pagina -= 1;
                        }
                    }

                    //Vuelvo a generar el cursor por haberlo recorrido ya
                    $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));
                    // Cerrar la conexión
                    //mysqli_close($conexion);
                    ?>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                            if (isset($_COOKIE["usuario"]) || isset($_COOKIE["moderador"])){
                                include "insertar.inc";
                            }
                        ?>
                    </div>
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