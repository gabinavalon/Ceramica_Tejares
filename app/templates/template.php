<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/25ed4f2ff5.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Martel:wght@200&display=swap" rel="stylesheet">

    <link href="<?= RUTA ?>web/css/responsive.css" rel="stylesheet" />
    <link href="<?= RUTA ?>web/css/style.css" rel="stylesheet" />
    <link href="<?= RUTA ?>web/css/style-custom.css" rel="stylesheet" />


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mx-3 titulo" href="<?= RUTA ?>">Cerámica Tejares</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RUTA ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RUTA ?>catalogo">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RUTA ?>noticias">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RUTA ?>tecnicas">Técnicas y Actividades</a>
                    </li>
                    <?php if (Sesion::existe()) {
                        if (Sesion::obtener()->getRol() == 'admin') { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Administración
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?= RUTA ?>admin">Inicio (Contactos)</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= RUTA ?>admin_articulos">Artículos</a></li>
                                    <li><a class="dropdown-item" href="<?= RUTA ?>admin_noticias">Noticias</a></li>
                                    <li><a class="dropdown-item" href="<?= RUTA ?>admin_usuarios">Usuarios</a></li>
                                </ul>
                            </li>

                    <?php }
                    } ?>
                </ul>

                <?php if (Sesion::existe()) : ?>

                    <div class="d-flex" id="usuario">
                        <div id="foto_usuario" style="background-image: url(<?= RUTA ?>web/img/users/<?= Sesion::obtener()->getFoto() ?>)"></div>
                        <form id="formulario_actualizar_foto" action="subir_foto" method="post" enctype="multipart/form-data">
                            <input type="file" name="foto" id="input_foto">
                            <input type="submit">
                        </form>
                        <div id="datos_usuario" class="nav-link"><?= Sesion::obtener()->getNombre() ?> <br><a href="<?= RUTA ?>logout">Cerrar sesión</a></div>
                    </div>
                <?php else : ?>
                    <form id="login" action="login" method="post" class="d-flex">
                        <input type="text" placeholder="email" name="email">
                        <input type="password" placeholder="password" name="password"><br>
                        <input type="submit" value="login" class="boton_formulario">
                        <input type="button" onclick="location.href = '<?= RUTA ?>registrar'" value="registrar" class="boton_formulario">
                    </form>
                <?php endif; ?>

                <form class="d-flex">
                    <!--Aquí meter el usuario -->
                </form>
            </div>
        </div>
    </nav>


    <main class="mt-5">
        <?= $contenido ?>
    </main>

    <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted mt-3">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
  >
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Conéctate con nuestras redes sociales:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="https://www.facebook.com/TalleEstudioCeramicaTejares/" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://www.instagram.com/ceramicatejares/?hl=es" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://github.com/gabinavalon/Ceramica_Tejares" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Cerámica Tejares
          </h6>
          <p>
            Aquí puedes ver un mapa de la página web y ver las distintas formas de contacto. 
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="<?= RUTA ?>catalogo" class="text-reset">Catálogo</a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
           Links de interés
          </h6>
          <p>
            <a href="<?= RUTA ?>tecnicas" class="text-reset">Técnicas y Actividades</a>
          </p>
          <p>
            <a href="<?= RUTA ?>noticias" class="text-reset">Noticias</a>
          </p>
          <p>
            <a href="<?= RUTA ?>#contacto" class="text-reset">Contacto</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Ayuda</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Contact
          </h6>
          <p><i class="fas fa-home me-3"></i> Albacete, Calle Tejares 17, 02002 </p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            ceramicatejares@gmail.com
          </p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

</footer>
<!-- Footer -->

</body>

<script type="text/javascript">
    $('#foto_usuario').click(function() {
        $('#input_foto').click();
    });

    $('#input_foto').change(function() {
        $('#formulario_actualizar_foto').submit();
    })
</script>


</html>