        <!--Empieza la página de insertar-->
        <div class="contenido">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    // date_default_timezone... es obligatorio si usais PHP 5.3 o superior
                    date_default_timezone_set('Europe/Madrid');
                    $fecha_actual = date("Y-m-d H:i:s");
                    ?>
                    <form action="mostrar.php?pagina" method="get">
                        <div>
                            <label for="titulo">Título:</label><br/>
                            <input type="text" id="titulo" name="titulo" value=""/>
                        </div>
                        <div>
                            <label for="texto">Texto:</label><br/>
                            <textarea id="texto" name="texto" rows="4" cols="40"></textarea>
                        </div>
                        <div>
                            <label for="activo">Activo:</label>
                            <input type="checkbox" id="activo" name="activo" checked="checked"/>
                        </div>
                        <div>
                            <input type="reset" id="limpiar" name="limpiar" value="Limpiar"/>
                            <input type="submit" id="enviar" name="enviar" value="Guardar"/>
                        </div>
                    </form>

                    <?php
                    //Si se pulsa enviar
                    if (isset($_GET['enviar']) && $_GET['enviar'] != "") {
                        // Recoger los valores
                        $titulo = "";
                        if (isset($_GET['titulo']) && $_GET['titulo'] != "")
                            $titulo = $_GET['titulo'];

                        $texto = "";
                        if (isset($_GET['texto']) && $_GET['texto'] != "")
                            $texto = $_GET['texto'];

                        $fecha = $fecha_actual;
        //                    if (isset($_GET['fecha']) && $_GET['fecha'] != "")
        //                        $fecha = $_GET['fecha'];

                        $activo = 0;
                        if (isset($_GET['activo']))
                            $activo = 1;

                        // Formar la consulta (insertar una fila)
                        $q = "insert into entrada values (0,'" . $titulo . "' , '" . $texto . "','" . $fecha . "','" . $activo . "')";
                        // Ejecutar la consulta en la conexión abierta. No hay "resultset"
                        mysqli_query($conexion, $q) or die(mysqli_error($conexion));

                        header("Location: mostrar.php?pagina");
                    }
                    ?>
                </div>
            </div>
        </div>