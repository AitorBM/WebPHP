<?php
    if (isset($_COOKIE["usuario"])){
        $usuario = $_COOKIE["usuario"];
    }
    if (isset($_COOKIE["moderador"])){
        $usuario = $_COOKIE["moderador"];
    }
?>

<div id="arriba" class="row">
    <div class="col-sm-12">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="fotos.php">Fotos</a></li>
                <li><a href="info.php">Info.</a></li>
                <li><a href="mostrar.php?pagina">Blog</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="login.php?salir"><?php echo $usuario ?></a></li>
            </ul>
        </nav>
    </div>
</div>
