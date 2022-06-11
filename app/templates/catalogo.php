<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<section class="product_section layout_padding">

    <div class="row justify-content-center">
        <div class="col-md-auto">
            <input type="text" id="buscador" name="buscador" placeholder="Buscar por el nombre " style="width: 50vw; padding: 10px; outline: none; border: 5px solid #CCD1E4; font-weight: 600;">
        </div>
    </div>

    <div class="row m-5">
        <div class="heading_container heading_center">
            <h2>
                Todos los productos
            </h2>
        </div>
        <?php
        $contador = 0;
        foreach ($articulos as $a) {
        ?>
            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="box">
                    <div class="img-box">
                        <img src="<?= RUTA ?>web/img/articulos/<?= $a->getFotos()[0]->getNombre_archivo() ?>" alt="Imagen de producto">
                        <a href="<?= RUTA ?>ver_articulo/<?= $a->getId() ?>" class="add_cart_btn">
                            <span>
                                Ver Artículo
                            </span>
                        </a>
                    </div>
                    <div class="detail-box">
                        <h5 class="nombre_articulo">
                            <?= $a->getTitulo() ?>
                        </h5>
                        <div class="product_info">
                            <h5>
                                <?= $a->getPrecio() ?> <span>€</span>
                            </h5>
                            <?php if (Sesion::existe()) : ?>


                                <i class="fa fa-heart like" data-id='<?= $a->getId() ?>'> <span id="likes_<?= $a->getId() ?>"><?= $a->getLikes() ?></span> </i>

                            <?php else : ?>

                                <i class="fa fa-heart like2" onclick="alert('Debes inciar sesión para poder dar me gusta')"> <span id="likes_<?= $a->getId() ?>"><?= $a->getLikes() ?></span> </i>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</section>

<script src="<?= RUTA ?>web/js/buscador.js"></script>
<script src="<?= RUTA ?>web/js/like.js"></script>

<?php
$contenido = ob_get_clean();

require 'template.php';
?>