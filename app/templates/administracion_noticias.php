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
        <a href="<?= RUTA ?>insertar_noticia" class="btn btn-primary">Nueva noticia</a>
        <br>
    </div>
</div>

<section class="container">



<table class="table mx-5">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Titulo</th>
            <th scope="col">Fecha</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($noticias as $noticia) : ?>
            <tr>
                <th scope="row"><?= $noticia->getId() ?></th>
                <td class="nombre_articulo"><?= $noticia->getTitulo() ?></td>
                <td><?= $noticia->getFecha() ?></td>
                <td>
                    <a href="<?= RUTA ?>ver_noticia/<?= $noticia->getId() ?>" class="btn btn-primary">Ver</a>
                    <a href="<?= RUTA ?>editar_noticia/<?= $noticia->getId() ?>" class="btn btn-warning">Editar</a>
                    <a href="<?= RUTA ?>borrar_noticia/<?= $noticia->getId() ?>/<?= $token ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>

</section>
<?php
    $contenido = ob_get_clean();

    require 'template.php';
    ?>