<?php
ob_start();
?>
<div class="row ">
  <div class="col-5"></div>
  <div class="col-5">
  <p class="text-center">
   <b><?php MensajesFlash::imprimir_mensajes(); ?></b>
  </p>
  </div>
</div>



<section class="row h-75">
  <div class="col-md-2"></div>
  <div class="col-md-8">

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= RUTA ?>web/img/noticias/<?= $n1->getFoto() ?>" alt="carousel noticias" width="100%"></img>
          <div class="container">
            <div class="carousel-caption">
              <h1><?= $n1->getTitulo() ?></h1>
              <p><a class="btn btn-lg btn-primary btn-noticia" href="<?= RUTA ?>ver_noticia/<?= $n1->getId() ?>">Ir a la noticia</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?= RUTA ?>web/img/noticias/<?= $n2->getFoto() ?>" alt="carousel noticias" width="100%"></img>
          <div class="container">
            <div class="carousel-caption">
              <h1><?= $n2->getTitulo() ?></h1>
              <p><a class="btn btn-lg btn-primary btn-noticia" href="<?= RUTA ?>ver_noticia/<?= $n2->getId() ?>">Ir a la noticia</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?= RUTA ?>web/img/noticias/<?= $n3->getFoto() ?>" alt="carousel noticias" width="100%" height="50%"></img>

          <div class="container">
            <div class="carousel-caption">
              <h1><?= $n3->getTitulo() ?></h1>
              <p><a class="btn btn-lg btn-primary btn-noticia" href="<?= RUTA ?>ver_noticia/<?= $n3->getId() ?>">Ir a la noticia</a></p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="col-md-2"></div>
</section>

<section class="product_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Nuestra Artesan??a
      </h2>
    </div>
    <?php
    $contador = 0;
    foreach ($ultimosArticulos as $a) {
      if ($contador == 0) {
        echo '<div class="row">';
      }
    ?>

      <div class="col-sm-6 col-lg-4">
        <div class="box">
          <div class="img-box">
            <img src="<?= RUTA ?>web/img/articulos/<?= $a->getFoto()?>" alt="Imagen de producto">
            <a href="<?= RUTA ?>ver_articulo/<?= $a->getId() ?>" class="add_cart_btn">
              <span>
                Ver Art??culo
              </span>
            </a>
          </div>
          <div class="detail-box">
            <h5>
              <?= $a->getTitulo() ?>
            </h5>
            <div class="product_info">
              <h5>
                <?= $a->getPrecio() ?> <span>???</span>
              </h5>
            <?php if (Sesion::existe()) : ?>

            
              <i class="fa fa-heart like" data-id='<?= $a->getId() ?>'> <span id="likes_<?=$a->getId()?>"><?= $a->getLikes() ?></span>  </i>

            <?php else : ?>

              <i class="fa fa-heart like2" onclick="alert('Debes inciar sesi??n para poder dar me gusta')"> <span id="likes_<?=$a->getId()?>"><?= $a->getLikes() ?></span>  </i>

            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    <?php
      $contador++;
      if ($contador == 3) {
        echo '</div>';
        $contador = 0;
      }
    }

    ?>





    <div class="btn_box">
      <a href="<?= RUTA ?>catalogo" class="view_more-link">
        Ver m??s
      </a>
    </div>
  </div>
</section>
<div class="row">
  <!--Section: Contact v.2-->
  <div class="col-2"></div>
  <section class="col-8">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4" id="contacto">Contacta con nosotras</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">??Tienes alguna pregunta? Por favor, no dudes en ponerte en contacto con nosotros. Puedes llamarnos, hablarnos por instagram, o bien rellenar este formulario de contacto.
    </p>

    <div class="row">

      <!--Grid column-->
      <div class="col-md-9 mb-md-0 mb-5">
        <form id="contact-form" name="contact-form" action="<?= RUTA ?>/contacto" method="POST">

          <!--Grid row-->
          <div class="row">

            <!--Grid column-->
            <div class="col-md-6">
              <div class="md-form mb-0">
                <input type="text" id="name" name="nombre" class="form-control" value='<?php if(Sesion::existe()){echo (Sesion::obtener()->getNombre() . ' ' . Sesion::obtener()->getApellidos());} ?>'>
                <label for="name" class="">Tu nombre</label>
              </div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6">
              <div class="md-form mb-0">
                <input type="text" id="email" name="email" class="form-control" value='<?php if(Sesion::existe()){echo (Sesion::obtener()->getEmail());} ?>'>
                <label for="email" class="">Tu email</label>
              </div>
            </div>
            <!--Grid column-->

          </div>
          <!--Grid row-->

          <!--Grid row-->
          <div class="row">
            <div class="col-md-12">
              <div class="md-form mb-0">
                <input type="text" id="subject" name="asunto" class="form-control">
                <label for="subject" class="">Asunto</label>
              </div>
            </div>
          </div>
          <!--Grid row-->

          <!--Grid row-->
          <div class="row">

            <!--Grid column-->
            <div class="col-md-12">

              <div class="md-form">
                <textarea type="text" id="message" name="texto" rows="2" class="form-control md-textarea"></textarea>
                <label for="message">Tu mensaje</label>
              </div>

            </div>
          </div>
          <!--Grid row-->

        </form>

        <div class="text-center text-md-left">
          <a class="btn btn-primary btn-noticia" onclick="document.getElementById('contact-form').submit();">Enviar</a>
        </div>
        <div class="status"></div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md-3 text-center">
        <ul class="list-unstyled mb-0">
          <li><i class="fas fa-map-marker-alt fa-2x"></i>
            <p>Albacete, Calle Tejares 17, 02002 </p>
          </li>

          <li><i class="fab fa-instagram fa-2x"></i>
            <p>@ceramicatejares</p>
          </li>

          <li><i class="fas fa-envelope mt-4 fa-2x"></i>
            <p>ceramicatejares@gmail.com</p>
          </li>
        </ul>
      </div>
      <!--Grid column-->

    </div>

  </section>
  <div class="col-2"></div>
</div>

<script src="<?= RUTA ?>web/js/like.js"></script>


<?php
$contenido = ob_get_clean();

require 'template.php';
?>