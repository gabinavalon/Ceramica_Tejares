<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<section class="row">
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
        <img src="/web/img/noticias/<?= $n1->getFoto()?>" alt="carousel noticias" width="100%"></img>
        <div class="container">
          <div class="carousel-caption">
            <h1><?= $n1->getTitulo()?></h1>
            <p><a class="btn btn-lg btn-primary" href="#">Ir a la noticia</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
      <img src="/web/img/noticias/<?= $n2->getFoto()?>" alt="carousel noticias" width="100%"></img>
        <div class="container">
          <div class="carousel-caption">
            <h1><?= $n2->getTitulo()?></h1>
            <p><a class="btn btn-lg btn-primary" href="#">Ir a la noticia</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
      <img src="/web/img/noticias/<?= $n3->getFoto()?>" alt="carousel noticias" width="100%" height="50%"></img>

        <div class="container">
          <div class="carousel-caption">
            <h1><?= $n3->getTitulo()?></h1>
            <p><a class="btn btn-lg btn-primary" href="#">Ir a la noticia</a></p>
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
          Nuestra Artesanía
        </h2>
      </div>
        <?php 
            $contador = 0;
           foreach ($ultimosArticulos as $a) { 
            if($contador == 0){
              echo '<div class="row">';
            }
             ?>
         
            <div class="col-sm-6 col-lg-4">
            <div class="box">
              <div class="img-box">
                <img src="/web/img/articulos/<?= $a->getFotos()[0]->getNombre_archivo() ?>" alt="Imagen de producto">
                <a href="" class="add_cart_btn">
                  <span>
                    Ver Artículo
                  </span>
                </a>
              </div>
              <div class="detail-box">
                <h5>
                  <?= $a->getTitulo() ?>
                </h5>
                <div class="product_info">
                  <h5>
                     <?= $a->getPrecio() ?> <span>€</span>
                  </h5>
                  <div class="star_container">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
            
         <?php 
          $contador++;
            if($contador == 3){
              echo '</div>';
              $contador = 0;
            }
          }
        ?>
   
     
          
        
    
      <div class="btn_box">
        <a href="" class="view_more-link">
          Ver más
        </a>
      </div>
    </div>
  </section>

<?php
$contenido = ob_get_clean();

require 'template.php';
?>