<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>




<section class="container">
    <?php if ($gestion == 'noticias') { ?>
        <h1>Gestión Noticia</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="titulo_noticia" placeholder="Titulo..." value="<?php if (isset($noticia)) {
                                                                                        echo $noticia->getTitulo();
                                                                                    } ?>"><br> <br>
            <label for="descripcion_noticia">Contenido de la noticia</label> <br>
            <textarea name="descripcion_noticia" id="descripcion_noticia" rows="10" cols="60"><?php if (isset($noticia)) {
                                                                                                    echo $noticia->getDescripcion();
                                                                                                } ?></textarea> <br>
            <label for="foto_noticia">Imagen para la noticia</label><br>
            <?php if (isset($noticia)) {
                echo "Debes subir de nuevo la foto anterior o una nueva <br>";
            } ?>
            <input type="file" name="foto_noticia" id="foto_noticia" accept="image/*"><br><br>

            <input type="submit" value="Subir noticia">
        </form>
    <?php } else if ($gestion == 'articulos') { ?>

        <h1>Gestión Articulo</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="titulo_articulo" placeholder="Titulo..." value="<?php if (isset($articulo)) {
                                                                                            echo $articulo->getTitulo();
                                                                                        } ?>"><br> <br>
            <label for="descripcion_articulo">Descripción del articulo</label> <br>
            <textarea name="descripcion_articulo" id="descripcion_articulo"><?php if (isset($articulo)) {
                                                                                echo $articulo->getDescripcion();
                                                                            } ?></textarea> <br>
            <select name="disponibilidad">
                <option value="0" <?php if (isset($articulo) && $articulo->getReservado() == 0) {
                                        echo "selected";
                                    } ?>>Disponible</option>
                <option value="1" <?php if (isset($articulo) && $articulo->getReservado() == 1) {
                                        echo "selected";
                                    } ?>>No disponible</option>
            </select> <br>
            <label for="foto_articulo">Imagen para el articulo</label><br>
            <?php if (isset($articulo)) {
                echo "Debes subir de nuevo la foto anterior o una nueva <br>";
            } ?>
            <input type="file" name="foto_articulo" id="foto_articulo" accept="image/*"><br><br>


            <label for="precio_articulo">Precio del articulo</label><br>
            <input type="number" name="precio_articulo" placeholder="Precio..." value="<?php if (isset($articulo)) {
                                                                                            echo $articulo->getPrecio();
                                                                                        } ?>"><br> <br>

            <input type="submit" value="Subir articulo">
        </form>

    <?php } else if ($gestion == 'usuarios') { ?>

        <h1>Gestión Articulo</h1>
        <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre_usuario">Nombre del usuario</label> <br>
            <input type="text" name="nombre_usuario" placeholder="Nombre..." value="<?php if (isset($usuario)) {
                                                                                        echo $usuario->getNombre();
                                                                                    } ?>"><br> <br>
                    <label for="apellidos_usuario">Apellidos del usuario</label> <br>
            <input type="text" name="apellidos_usuario" placeholder="Apellidos..." value="<?php if (isset($usuario)) {
                                                                                        echo $usuario->getApellidos();
                                                                                    } ?>"><br> <br>

            <label for="email_usuario">Email del usuario</label> <br>
            <input  type="mail" name="email_usuario" id="email_usuario" placeholder="Email..." value="<?php if(isset($usuario)){echo $usuario->getEmail();}?>"><br>


            <label for="password_usuario">Password del usuario</label> <br>
            <input  type="text" name="password_usuario" placeholder="Contraseña..." value="<?php if(isset($usuario)){echo $usuario->getPassword();}?>"><br>
            <label for="foto_noticia">Imagen del usuario</label><br>

            <label for="telefono_usuario">Telefono del usuario</label> <br>
            <input  type="number" name="telefono_usuario"   value="<?php if(isset($usuario)){echo $usuario->getTelefono();}?>"><br>
            <label for="foto_noticia">Imagen del usuario</label><br>

            <input type="submit" value="Modificar usuario">
        </form>




    <?php } ?>
</section>




<?php
$contenido = ob_get_clean();

require 'template.php';
?>