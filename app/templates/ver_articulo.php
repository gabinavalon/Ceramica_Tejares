<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= $articulo->getTitulo()?></h3>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="img/${elLibro.portada}" class="img" alt="portada del libro" id="portada"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h4 class="box-title mt-5">Descripción</h4>
                    <p><?= $articulo->getDescripcion()?></p>

                    <c:if test="${sessionScope.administrador || sessionScope.cliente}">
                        <a class="btn btn-outline-success" href="#" onclick="alert('¡Estamos trabajando en ello!')" role="button">Me interesa</a>
                    </c:if>
                    <h3 class="box-title mt-5">Información adicional</h3>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-book "></i> Precio: <?= $articulo->getPrecio()?></li>
                        <li><i class="fa fa-book "></i> Disponibilidad: <?= $articulo->getReservado()?></li>
                    </ul>

                    <div id="half-stars-example">
                        <div class="rating-group">
                            <input class="rating__input rating__input--none" checked name="rating2" id="rating2-0" value="0" type="radio">
                            <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                            <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-05" value="0.5" type="radio">
                            <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-10" value="1" type="radio">
                            <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-15" value="1.5" type="radio">
                            <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-20" value="2" type="radio">
                            <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-25" value="2.5" type="radio" checked>
                            <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-30" value="3" type="radio">
                            <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-35" value="3.5" type="radio">
                            <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-40" value="4" type="radio">
                            <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-45" value="4.5" type="radio">
                            <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating2" id="rating2-50" value="5" type="radio">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$contenido = ob_get_clean();

require 'template.php';
?>