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
                            <h1 class="fw-bolder mb-1"><?= $noticia->getTitulo()?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Publicado el: <?= $noticia->getFecha()?></div>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="<?= RUTA ?>web/img/noticias/<?= $noticia->getFoto()?>" alt="Imagen de la noticia" /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4"><?= $noticia->getDescripcion()?></p>

                        </section>
                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4"><textarea class="form-control" rows="3" placeholder="¿Quiéres añadir un comentario?"></textarea></form>
                                <!-- Single comment-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="img-fluid rounded-circle" src="https://previews.123rf.com/images/bowie15/bowie151112/bowie15111200072/11739451-hombre-calvo-con-expresi%C3%B3n-de-asombro.jpg" alt="..." width="50px" height="50px"/></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Paquito</div>
                                        Me encanta la noticia espero que se pase ya la movida esta del covi de una vez!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>

<?php
$contenido = ob_get_clean();

require 'template.php';
?>