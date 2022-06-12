<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= $noticia->getTitulo() ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Publicado el: <?= $noticia->getFecha() ?></div>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="<?= RUTA ?>web/img/noticias/<?= $noticia->getFoto() ?>" alt="Imagen de la noticia" /></figure>
                <!-- Post content-->
                <div>

                 <?= $noticia->getDescripcion() ?>

                </div>
                <br><br>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <div class="mb-4">
                            <textarea class="form-control enviar_mensaje" id='enviar_mensaje' rows="3" placeholder="¿Quiéres añadir un comentario?"></textarea>
                            <input type="hidden" id="id_noticia" value="<?= $noticia->getId() ?>">
                            <button id="btn_enviar" class="btn btn-info mt-2">Enviar</button>
                        </div>



                        <!-- Single comment-->
                        <?php if(isset ($comentarios)){ 
                        foreach ($comentarios as $c) : ?>
                            <div class="row my-3" >
                                <div class="col-2">
                                    <img class="img-fluid rounded-circle" src="<?= RUTA ?>web/img/users/<?= $c->getUser()->getFoto() ?>" alt="Foto usuario" width="50px" height="50px" />
                                    <br> <?= $c->getUser()->getNombre() ?>
                                </div>
                                <div class="col-7">
                                    <textarea class="form-control" rows="3" disabled><?= $c->getTexto() ?></textarea>


                                </div>
                                <div class="col-2">
                                    
                                    <?= $c->getFecha() ?>
                                    <?php if (Sesion::existe()){
                                            if($c->getUser()->getId() == Sesion::obtener()->getId()) { ?>
                                        <button class="btn btn-danger btn-sm    " id="borrar_comentario" data-id="<?= $c->getId() ?>">Eliminar</button>
                                    <?php }} ?>
                                </div>

                            </div>

                        <?php endforeach;} ?>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>

<script type="text/javascript">
    $('#borrar_comentario').click(function() {
        id = $(this).attr('data-id');
        capa = $(this).parent().parent();

        $.ajax({
            url: "<?= RUTA ?>borrar_comentario/" + id,
            dataType: "json",
            success: function(data) {

                if (data.respuesta == 'ok') {

                    capa.remove();
                    location.reload();
                } else {
                    alert("No se ha podido borrar el mensaje");

                }

            },
        });
    });

    $('#btn_enviar').click(function() {

        texto = $('#enviar_mensaje').val();
        id_noticia = <?= $noticia->getId() ?>;
        id_usuario = <?php if (Sesion::existe()){
            Sesion::obtener()->getId();
            } ?>;

        console.log(texto);
        console.log(id_noticia);
        console.log(id_usuario);


        $.ajax({
            url: "<?= RUTA ?>insertar_comentario",
            method: "POST",
            data: {
                texto: texto,
                id_noticia: id_noticia,
                id_usuario: id_usuario
            },
            success: function(data) {
                if (data.respuesta) {
                    location.reload();
                } else {
                    alert("No se ha podido comentar");

                }

            },
        });
    });
</script>




<?php
$contenido = ob_get_clean();

require 'template.php';
?>