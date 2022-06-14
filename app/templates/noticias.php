<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

    <section class="container-fluid ml-3">

      <div class="row">

        <div class="col-md-1"></div>
        <div class="col-md-10 mb-4">

          <article>
    <?php foreach ($noticias as $noticia): ?>
      
    
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="bg-image hover-overlay shadow-1-strong rounded ripple" data-mdb-ripple-color="light">
                  <img src="<?= RUTA ?>web/img/noticias/<?= $noticia->getFoto()?>" class="img-fluid" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
              </div>

              <div class="col-md-8 mb-4">
                <h5><?=$noticia->getTitulo()?></h5>
                <p>
                    <?= substr($noticia->getDescripcion(), 0, 400) ?> ...
                </p>

                <a href="<?= RUTA ?>ver_noticia/<?= $noticia->getId() ?>" type="button" class="btn btn-primary btn-noticia">Leer</a>
              </div>
            </div>

            <?php endforeach; ?>

          </article>
         <div class="col-md-1"></div>
        </div>
      </div>
      <!--Grid row-->

    </section>

    <?php
$contenido = ob_get_clean();

require 'template.php';
?>