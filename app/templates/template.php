<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

        .carousel .item {
            height: 300px;
        }

        .item img {
            position: absolute;
            top: 0;
            left: 0;
            min-height: 300px;
        }

        .filtro {
            display: none !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cerámica Tejares</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= RUTA ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RUTA ?>catalogo">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RUTA ?>noticias">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RUTA ?>tecnicas">Meteriales y Técnicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Clases</a>
                    </li>
                </ul>

                <?php if (Sesion::existe()) : ?>

                    <div class="d-flex" id="usuario">
                        <div id="foto_usuario" style="background-image: url(<?= RUTA ?>web/imagenes/<?= Sesion::obtener()->getFoto() ?>)"></div>
                        <form id="formulario_actualizar_foto" action="subir_foto" method="post" enctype="multipart/form-data">
                            <input type="file" name="foto" id="input_foto">
                            <input type="submit">
                        </form>
                        <div id="datos_usuario"><?= Sesion::obtener()->getNombre() ?> <br><a href="logout">Cerrar sesión</a></div>
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