<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<link href="<?= RUTA ?>web/js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= RUTA ?>web/js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>


<script type="text/javascript">
    $(function() {
        $("#descripcion_noticia").jqte();
    });
</script>


<section class="container">
    <?php if ($gestion == 'noticias') { ?>
        <h1>Insertar Noticia</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="titulo_noticia" placeholder="Titulo..." value="<?php if (isset($noticia)) {
                                                                                        echo $noticia->getTitulo();
                                                                                    } ?>"><br> <br>
            <label for="descripcion_noticia">Contenido de la noticia</label>
            <textarea name="descripcion_noticia" id="descripcion_noticia"><?php if (isset($noticia)) {echo $noticia->getDescripcion();} ?></textarea>
            <label for="foto_noticia">Imagen para la noticia</label><br>
            <?php if (isset($noticia)) {
                echo "Debes subir de nuevo la foto anterior o una nueva <br>";
            } ?>
            <input type="file" name="foto_noticia" id="foto_noticia" accept="image/*"><br><br>
     "
            <input type="submit" value="Subir noticia">
        </form>
    <?php } else if ($gestion == 'articulos') { ?>

        <h1>Insertar Articulo</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="titulo_articulo" placeholder="Titulo..." value="<?php if(isset($articulo)){echo $articulo->getTitulo();}?>"><br> <br>
            <label for="descripcion_articulo">Descripción del articulo</label> <br>
            <textarea name="descripcion_articulo" id="descripcion_articulo"><?php if (isset($articulo)) {echo $articulo->getDescripcion();} ?></textarea> <br>
            <label for="foto_articulo">Imagen para el articulo</label><br>
            <?php if (isset($articulo)) {
                echo "Debes subir de nuevo la foto anterior o una nueva <br>";
            } ?>
            <input type="file" name="foto_articulo" id="foto_articulo" accept="image/*"><br><br>


            <label for="precio_articulo">Precio del  articulo</label><br>
            <input type="number" name="precio_articulo" placeholder="Precio..." value="<?php if (isset($articulo)) {
                                                                                            echo $articulo->getPrecio();
                                                                                        } ?>"><br> <br>

            <input type="submit" value="Subir articulo">
        </form>
  
    <?php } ?>
</section>




<?php
$contenido = ob_get_clean();

require 'template.php';
?>