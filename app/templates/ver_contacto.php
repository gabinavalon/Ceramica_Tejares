<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Asunto</h4>
            <h3 class="card-title"><?= $contacto->getAsunto()?></h3>
            <div class="row">

                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h4 class="box-title mt-5">Texto</h4>
                    <p><?= $contacto->getTexto()?></p>




                    <h3 class="box-title mt-5">Información adicional</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-book "></i> Nombre: <?= $contacto->getNombre()?> </li>
                        <li><i class="fa fa-book "></i> Email:  <?= $contacto->getEmail()?>

                        </li>
                    </ul>

                    <a href="<?= RUTA ?>borrar_contacto/<?= $contacto->getId() ?>" class="btn btn-danger">Eliminar</a>
                    <a href="<?= RUTA ?>admin" class="btn btn-info">Volver</a>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
$contenido = ob_get_clean();

require 'template.php';
?>