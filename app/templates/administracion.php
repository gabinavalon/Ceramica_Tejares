<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>


<article class="row">
    <div class="col-1 col-lg-4"></div>
    <a class="card  col-10  col-lg-4" href="<?= RUTA ?>admin_usuarios">
        <img class="card-img-top" src="<?= RUTA ?>web/img/visitas.png" alt="Usuarios">
        <div class="card-body">
            <h5 class="card-title">Administrar Usuarios</h5>
            <p class="card-text">Crea, edita y elimina usuarios, también sus likes y comentarios.</p>
        </div>
    </a>
    <div class="col-4"></div>
</article>
<article class="row my-3">
    <div class="col-1 col-lg-4"></div>
    <a class="card col-10  col-lg-4" href="<?= RUTA ?>admin_articulos">
        <img class="card-img-top" src="<?= RUTA ?>web/img/adminproductos.png" alt="Productos admin">
        <div class="card-body">
            <h5 class="card-title">Administrar Artículos</h5>
            <p class="card-text">Da de alta artículos, modifica, o elimina de la base de datos.</p>

        </div>
    </a>
    <div class="col-4"></div>
</article>
<article class="row">
    <div class="col-1 col-lg-4"></div>
    <a class="card col-10  col-lg-4" href="<?= RUTA ?>admin_noticias">
        <img class="card-img-top" src="<?= RUTA ?>web/img/noticias/ceramica1.png" alt="Noticias">
        <div class="card-body">
            <h5 class="card-title">Administrar Noticias</h5>
            <p class="card-text">Añade noticias, edita las existententes o borra noticias de la base de datos.</p>
        </div>
    </a>
    <div class="col-4"></div>
</article>



<div class="container my-3">
    <h1 class=" my-3">Mails de contacto</h1>

    <table class="table mx-5">
    <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Asunto</th>
            <th scope="col">Fecha</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contactos as $contacto) : ?>
        
        <tr>
            <th scope="row"><?= $contacto->getId() ?></th>
            <td><?= $contacto->getNombre() ?></td>
            <td><?= $contacto->getEmail() ?></td>
            <td><?= $contacto->getAsunto() ?></td>
            <td><?= $contacto->getFecha() ?></td>
            <td>
                <?php if ($contacto->getLeído() == 0) : ?>
                    <a href="<?= RUTA ?>ver_contacto/<?= $contacto->getId() ?>" class="btn btn-primary">Ver (Sin leer)</a>

                <?php else : ?>
                <a href="<?= RUTA ?>ver_contacto/<?= $contacto->getId() ?>"><button class="btn btn-secondary">Ver (Leído)</button></a>
                <?php endif; ?>

                
                <a href="<?= RUTA ?>borrar_contacto/<?= $contacto->getId() ?>" class="btn btn-danger">Eliminar</a>
            </td>

    </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>


    <?php
    $contenido = ob_get_clean();

    require 'template.php';
    ?>