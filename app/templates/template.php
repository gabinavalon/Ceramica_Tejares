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

    <link href="<?= RUTA ?>web/css/responsive.css" rel="stylesheet" />
    <link href="<?= RUTA ?>web/css/style.css" rel="stylesheet" />

    <style type="text/css">
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        .carousel .carousel-item {
            height: 400px;
        }

        .carousel-item img {
            position: absolute;
            top: 0;
            left: 0;
            min-height: 400px;
        }

        .filtro {
            display: none !important;
        }

        #cruz,
        #tick,
        #preloader {
            height: 25px;
            vertical-align: middle;
            display: none;
        }

        #formulario_actualizar_foto {
            display: none;
        }

        #foto_usuario {
            height: 50px;
            width: 50px;
            background-size: cover;
            background-position: center;
            border-radius: 40px;
            box-shadow: 0px 0px 5px 0px #aaa;
            margin: 5px;
        }



        .like:hover {
            color: red !important;
            transition: 0.3s;
        }

        .like2:hover {
            color: red !important;
            font-size: 1.5em;
            transition: 0.3s;
        }

        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mx-3" href="#">Cerámica Tejares</a>
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
                        <div id="datos_usuario"><?= Sesion::obtener()->getNombre() ?> <br><a href="<?= RUTA?>logout">Cerrar sesión</a></div>
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