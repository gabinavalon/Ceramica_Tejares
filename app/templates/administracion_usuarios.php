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

<section class="container">


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Nombre y Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Telefono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
                <tr>
                    <th scope="row"><?= $usuario->getId() ?></th>
                    <td><?= $usuario->getNombre() . " " . $usuario->getApellidos() ?></td>
                    <td><?= $usuario->getEmail() ?></td>
                    <td><?= $usuario->getTelefono() ?></td>
                    <td>
                        <a href="<?= RUTA ?>editar_usuario/<?= $usuario->getId() ?>" class="btn btn-primary  btn-sm">Editar</a>
                        <a href="<?= RUTA ?>borrar_usuario/<?= $usuario->getId() ?>/<?= $token ?>" class="btn btn-danger  btn-sm">Borrar</a>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

</section>
<?php
$contenido = ob_get_clean();

require 'template.php';
?>