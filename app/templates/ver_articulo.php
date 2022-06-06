<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= $articulo->getTitulo()?></h3>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="<?= RUTA ?>web/img/articulos/<?= $articulo->getFotos()[0]->getNombre_archivo()?>" class="img-fluid" alt="portada del libro" id="portada"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h4 class="box-title mt-5">Descripción</h4>
                    <p><?= $articulo->getDescripcion()?></p>


                        <a class="btn btn-outline-success" href="#" onclick="alert('¡Estamos trabajando en ello!')" role="button">Me interesa</a>

                    <h3 class="box-title mt-5">Información adicional</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-book "></i> Precio: <?= $articulo->getPrecio()?> €</li>
                        <li><i class="fa fa-book "></i> Disponibilidad: <?= $articulo->getReservado()?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$contenido = ob_get_clean();

require 'template.php';
?>