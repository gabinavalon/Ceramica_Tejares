<?php ob_start() ?>


<section class="h-100 bg-dark">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">

                        <div class="col-xl-6 h-100  mt-3">
                            <div class="card-body p-md-5 text-black ">
                                <h3 class="mb-5 text-uppercase">Inicia Sesión</h3>

                                <form action="login" method="post">
                                    <div class="row">

                                        <?php if ($alert) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php MensajesFlash::imprimir_mensajes() ?>
                                            </div>
                                        <?php endif ?>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="form3Example1m1" name="email" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Example1m1">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="password" name="password" id="form3Example1n1" class="form-control form-control-lg" />
                                                <label class="form-label" for="form3Example1n1">Contraseña</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--   <div class="form-outline mb-4">
                                       <a href="<? //= RUTA
                                                ?>forgot">¿Has olvidado tu contraseña?</a>
                                    </div> -->

                                    <div class="d-flex justify-content-end pt-3">
                                        <input type="button" onclick="location.href = '<?= RUTA ?>registrar'" value="Registrar" class="btn btn-light btn-lg">
                                        <input type="submit" value="login" class="btn btn-success btn-lg ms-2">
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="card-footer text-muted mt-5">
                                    <blockquote class="blockquote ms-2">
                                        <p> ¿Dices que nada se crea?
                                            No te importe, con el barro
                                            de la tierra, haz una copa
                                            para que beba tu hermano.</p>
                                        <footer class="blockquote-footer">Antonio Machado, <cite title="Source Title">Proverbios y Canciones - XXXVII</cite></footer>
                                    </blockquote>
                                </div>
                            </div>


                        </div>
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="<?= RUTA ?>web/img/entrada.png" alt="Foto para registro" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$contenido = ob_get_clean();
require 'template.php';
?>