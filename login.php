<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
        //Si se pulsa enviar
        if (isset($_GET['entrar']) && $_GET['entrar'] == "Entrar") {
            // Recoger los valores
            $usuario = $_GET['user'];
            $contra = $_GET['pass'];
            $fecha = $fecha_actual;

            try{
                // Formar la consulta (seleccionando una fila)
                $q = "select * from usuarios WHERE nick = '" .$usuario."';";
                // Ejecutar la consulta en la conexión abierta y obtener el "resultset" o abortar y mostrar el error
                $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));
                if (mysqli_num_rows($r)>0){
                    $fila = mysqli_fetch_assoc($r);
                    if ($fila['nick'] == $usuario){
                        if ($fila['password'] == $contra){
                            if ($fila['moderador'] == 1){
                                setcookie("moderador", $fila['nick'], time()+3600);
                            } elseif ($fila['moderador'] == 0){
                                setcookie("usuario", $fila['nick'], time()+3600);
                            }

                            header("Location: mostrar.php?pagina");
                        } else {
                            $contraIncorrecta = true;
                        }
                    } else {
                        $usuarioIncorrecto = true;
                    }
                }
            } catch (Exception $ex){
                $error = true;
            }
        }
        ?>

        <?php
        //Si se pulsa salir
        if (isset($_GET['salir'])){
            if (isset($_COOKIE["usuario"])){
                setcookie("usuario", "", time()-3600);
            }
            if (isset($_COOKIE["moderador"])){
                setcookie("moderador", "", time()-3600);
            }

            header("Location: index.php");
        }
        ?>
        <!-- Empieza la página de contacto -->
        <div class="contenido">
            <div class="row">
                <div class="col-sm-12">
                    <p></p>
                    <p>Iniciar sesión</p>
                    <form action="login.php" method="get">
                        <div>
                            <label for="titulo">Usuario:</label>
                            <input type="text" id="usuario" name="user" value=""/>
                        </div>
                        <div>
                            <label for="texto">Contraseña:</label>
                            <input type="password" id="contra" name="pass"/>
                        </div>
                        <div>
                            <input type="submit" id="identrar" name="entrar" value="Entrar"/>
                        </div>
                    </form>
                    <?php
                    //comprobaciones al iniciar sesión
                    if ($contraIncorrecta)
                        echo "<p color='red'>Contraseña incorrecta</p>";
                    if ($usuarioIncorrecto)
                        echo "<p color='red'>Usuario incorrecto</p>";
                    if ($error)
                        echo "<p color='red'>Error</p>";
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p></p>
                    <p>Crear usuario</p>
                    <form action="login.php" method="get">
                        <div>
                            <label for="titulo">Usuario:</label>
                            <input type="text" id="usuario" name="user" value=""/>
                        </div>
                        <div>
                            <label for="texto">Contraseña:</label>
                            <input type="text" id="contra" name="pass"/>
                        </div>
                        <div>
                            <input type="submit" id="idcrear" name="create" value="Crear"/>
                        </div>
                    </form>
                    <?php
                    //Si se pulsa Crear
                    if (isset($_GET['create']) && $_GET['create'] == "Crear") {
                        // Recoger los valores
                        $usuario = $_GET['user'];
                        $contra = $_GET['pass'];
                        $fecha = $fecha_actual;

                        $q = "select * from usuarios where nick='$usuario'";
                        $r = mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                        if (mysqli_num_rows($r) == 0){
                            if ($_GET['user'] != "" && $_GET['pass'] != ""){
                                // Formar la consulta (insertar una fila)
                                $q = "insert into usuarios values (0 ,'" . $usuario . "' , '" . $contra . "', 0)";
                                // Ejecutar la consulta en la conexión abierta. No hay "resultset"
                                mysqli_query($conexion, $q) or die(mysqli_error($conexion));
                            }
                        } else {
                            echo "
                                <p>El usuario ya existe, prueba con otro nombre.</p>
                            ";
                        }
                    }
                    ?>
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