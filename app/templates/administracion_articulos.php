<?php
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-3"></div>
    <div class="col-6">
        <p> <?php MensajesFlash::imprimir_mensajes(); ?> </p>
    </div>
    <div class="col-3"></div>
</div>

<div class="row justify-content-center">
    <div class="col-md-auto">
        <a href="<?= RUTA ?>insertar_articulo" class="btn btn-primary">Nuevo artículo</a>
        <br>
    </div>
</div>

<table class="table mx-5">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Titulo</th>
            <th scope="col">Precio</th>
            <th scope="col">Disponible</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articulos as $articulo) : ?>
            <tr>
                <th scope="row"><?= $articulo->getId() ?></th>
                <td class="nombre_articulo"><?= $articulo->getTitulo() ?></td>
                <td><?= $articulo->getPrecio() ?> €</td>
                <td>
                    <?php if ($articulo->getReservado() == 0) : ?>
                        Disponible
                    <?php else : ?>
                        No disponible
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= RUTA ?>ver_articulo/<?= $articulo->getId() ?>" class="btn btn-primary">Ver</a>
                    <a href="<?= RUTA ?>editar_articulo/<?= $articulo->getId() ?>" class="btn btn-warning">Editar</a>
                    <a href="<?= RUTA ?>borrar_articulo/<?= $articulo->getId() ?>/<?= $token ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>


<?php
$contenido = ob_get_clean();

require 'template.php';
?>