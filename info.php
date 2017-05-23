<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Información</title>
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
        <!--Empieza la página de info-->
        <div class="contenido">
        <div class="row"><!-- Primer párrafo -->
            <div class="col-sm-12">
                <h3>Aitor Bringas Martinez</h3>
                <p>
                    Así me llamo 😜. Nací el 15 de julio de 1993 en el hospital Txagorritxu de Vitoria-Gasteiz, Álava.
                </p>
                <p>
                    Desde los 8 años aproximadamente me aficioné a la informática cuando empecé a ir a una ciber
                    de mi barrio que se llamaba "Rapsodia", lo digo en pasado porque hoy en día el dueño tiene
                    un bar justo enfrente de donde estaba el la ciber y ahora en ese local hay una peluquería 😢,
                    la que no uso para nada porque el pelo me lo corto yo mismo.
                </p>
                <p>
                    Hice un montón de amigos aunque todos tenían mínimo 10 años más que yo, supongo que me veían
                    como el hermano pequeño y me llamaban el enano.
                    Yo que no sabia ni como se encendian esas máquinas me parecía increíble ver como ellos porque
                    se aburrian desmontaban todas las piezas del ordenador y las volvían a montar en cuestión de minutos,
                    y siempre quise aprender todo lo que envolvía a este mundo, aunque como es lógico a lo que iva era a jugar 😜
                </p>
                <p>
                    Mi primer ordenador no lo tube hasta mucho después pero ya había aprendido un montón, y tube claro que quería
                    estudiar algo de esto y si es posible dedicarme a ello.
                    Cuando tuve la oportunidad me apunté al ciclo medio de Sistemas microinformáticos y redes(Técnico informático),
                    al acabarlo hice la prueba de acceso y me apunté a Desarrollo de Aplicaciones web, módulo en el que me quedé sin
                    convocatorias por estar trabajando como vendedor en mediamarkt y no dedicarle el tiempo suficiente.
                    Por último estoy haciendo Desarrollo de aplicaciones multiplataforma para acabar mi formación he intentar
                    apuntarme de nuevo al que dejé a medias.
                </p>
            </div>
        </div>
        <div class="row"><!-- Segundo párrafo -->
            <div class="col-sm-12">
                <h3>Información buscada en:</h3>
                <ul>
                    <li><a href="http://www.character-code.com/emoticons-html-codes.php">Emoticonos.</a></li>
                    <li><a href="https://www.w3schools.com/">Reglas html y css.</a></li>
                    <li><a href="http://teamx6tence.pro/">Imágen x6tence.</a></li>
                    <li><span>Imágenes de ajedrez creadas por mí.</span></li>
                </ul>
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