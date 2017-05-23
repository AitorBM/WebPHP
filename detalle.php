<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrada</title>
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
        <?php
        // date_default_timezone... es obligatorio si usais PHP 5.3 o superior
        date_default_timezone_set('Europe/Madrid');
        $fecha_actual = date("Y-m-d H:i:s");
        $contraIncorrecta = false;
        $usuarioIncorrecto = false;
        $error = false;
        ?>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //Consulto y muestro la entrada seleccionada
            try {
                // Formar la consulta (seleccionando una fila)
                $q = "select * from entrada WHERE id = '" . $id . "';";
                // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
                $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));
                //Si hay filas continuo
                if (mysqli_num_rows($r) > 0) {
                    //Guardo la fila
                    $fila = mysqli_fetch_assoc($r);
                    echo "<div style='height: 5em'>
                          </div>
                        <strong><p>".$fila['titulo']."</p></strong>
                        <p>".$fila['texto']."</p>
                        <p>".$fila['fecha']."</p>
                        <hr/>
                    ";
                }
            } catch (Exception $ex) {
                $error = true;
            }
            switch ($id){
                case 0:
                    echo "
                        <ul class=\"pager\">
                          <li class='next' ><a href=\"detalle.php?id=".($id+1)."\">Siguiente</a></li>
                        </ul>
                    ";
                    break;
                default:
                    echo "
                        <ul class=\"pager\">
                          <li class='previous'><a href=\"detalle.php?id=".($id-1)."\">Anterior</a></li>
                          <li class='next' ><a href=\"detalle.php?id=".($id+1)."\">Siguiente</a></li>
                        </ul>
                    ";
                    break;
            }
            //Consulto y muestro los comentarios asociados
            echo "
                <h3>Comentarios</h3>
            ";
            try {
                // Formar la consulta (seleccionando una fila)
                $q = "select * from comentario WHERE entrada_id = '" . $id . "';";
                // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
                $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));
                //Si hay filas continuo
                if (mysqli_num_rows($r) > 0) {
                    while ($fila = mysqli_fetch_assoc($r)) {
                        if (isset($_COOKIE["moderador"])){
                            echo "
                                <hr/>
                                <form action='detalle.php' method='get'>
                                    <label for='borrar'>Eliminar</label>
                                    <input id='id' name='id' value='".$id."' hidden/>
                                    <input type='submit' id='borrar' name='borrar' value='" . $fila['id'] . "'/>
                                </form>";
                        }
                        echo "
                        <p>".$fila['texto']."</p>
                        <p>".$fila['email'].", ".$fila['fecha']."</p>
                        <p></p>
                        <hr/>
                        ";
                    }
                }
                if (isset($_GET['borrar']) && isset($_COOKIE[moderador])){
                    // Borramos el comentario
                    $q = "delete from comentario where id='" . $_GET['borrar'] . "'";
                    // Ejecutar la consulta en la conexión abierta. No hay "resultset"
                    mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                    $id_entrada = $_GET['id'];

                    header("Location: detalle.php?id=$id_entrada");
                }
            } catch (Exception $ex) {
                $error = true;
            }
        }

        echo "
            <form action=\"detalle.php\" method=\"get\">
            <div>
                <label for=\"email\">Email:</label><br/>
                <input type=\"text\" id=\"email\" name=\"email\" value=\"\"/>
            </div>
            <div>
                <label for=\"comentario\">Comentario:</label><br/>
                <textarea id=\"comentario\" name=\"comentario\" rows=\"4\" cols=\"40\"></textarea>
            </div>
            <div>
                <label for=\"activo\">Activo:</label>
                <input type=\"checkbox\" id=\"activo\" name=\"activo\" checked=\"checked\"/>
            </div>
            <div>
                <input id='id' name='id' value='".$id."' hidden/>
                <input type=\"reset\" id=\"limpiar\" name=\"limpiar\" value=\"Limpiar\"/>
                <input type=\"submit\" id=\"enviar\" name=\"enviar\" value=\"Guardar\"/>
            </div>
        ";
            //Si se pulsa enviar
            if (isset($_GET['enviar']) && $_GET['enviar'] != "") {
                // Recoger los valores
                $email = "";
                if (isset($_GET['email']) && $_GET['email'] != "")
                    $email = $_GET['email'];

                $comentario = "";
                if (isset($_GET['comentario']) && $_GET['comentario'] != "")
                    $comentario = $_GET['comentario'];

                $fecha = $fecha_actual;
                //                    if (isset($_GET['fecha']) && $_GET['fecha'] != "")
                //                        $fecha = $_GET['fecha'];

                $activo = 0;
                if (isset($_GET['activo']))
                    $activo = 1;

                $id_entrada = $_GET['id'];

                // Formar la consulta (insertar una fila)
                $q = "insert into comentario values (0,'" . $email . "' , '" . $comentario . "','" . $fecha . "','" . $activo . "','" . $id_entrada . "')";
                // Ejecutar la consulta en la conexión abierta. No hay "resultset"
                mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                header("Location: detalle.php?id=$id_entrada");
            }
            ?>
        </form>
    </div>
</body>
</html>