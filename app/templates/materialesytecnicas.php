<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<article class="container">

    <section class="row text-center">
        <div class="col-12">
            <h1>Técnicas y Actividades</h1>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <br>
                <p>
                    En esta sección encontrarás toda la información sobre las técnicas y actividades que utilizamos en nuestro taller.
                </p>
            </div>
        </div>
        <br><br><br>
        <div class="container text-start h-auto">

            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= RUTA ?>web/img/torno.png" class="card-img" alt="Fases del Torneado">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">Torno</h2>
                            <br><br>
                            <p class="card-text">El torno es la herramienta con la que trabajamos que más simboliza al ceramista. <br> <br>
                                El torneado se utiliza para aprovechar la fuerza de rotación con la mañana y fuerza del alfarero,
                                para darle la forma y tamaño deseada a la pieza.
                                Aunque sea la técnica más solicitada por nuestro alumnado, es la técnica más compleja, ya que requiere de una gran capacidad de concentración y
                                de visualización para conseguir resultados. <br> <br>
                                Esto tampoco debe desanimar a nadie, la paciencia y la persistencia hacen al artista.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-start h-auto">

            <div class="card mb-3">
                <div class="row no-gutters">

                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">Cerámica Manual y Modelado</h2>
                            <br><br>
                            <p class="card-text"> 
                                Todas las piezas tienen que pasar por las manos del artista, se hayan hecho a torno o no. Perfilar, alisar, pulir detalles..
                                Y después están las piezas que de principio a final están hechas a mano. <br><br>
                                Estas piezas pueden ser de cualquier tamaño, o forma, el límite lo marca la imaginación y las posibilidades del barro.
                                Cualquier cosa hecha a torno se puede hacer a mano. Vasos, platos, esculturas... <br><br>
                                El artista tiene total libertad de crear su pieza, de modelarla y de disfrutar con el barro y sus capacidades.
                            </p>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= RUTA ?>web/img/ceramicamanual.png" class="card-img" alt="Fases del Torneado">
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-end h-auto">
            <div class="row my-2">
                <h2>Cerámica Manual y Modelado</h2>
            </div>

            <div class="row">

                <div class="col-12 col-md-8 my-3 text-start">
                    <p>
                        Todas las piezas tienen que pasar por las manos del artista, se hayan hecho a torno o no. Perfilar, alisar, pulir detalles... <br><br>
                        Y después están las piezas que de principio a final están hechas a mano. <br><br>
                        Estas piezas pueden ser de cualquier tamaño, o forma, el límite lo marca la imaginación y las posibilidades del barro. <br><br>
                        Cualquier cosa hecha a torno se puede hacer a mano. Vasos, platos, esculturas... <br><br>
                        El artista tiene total libertad de crear su pieza, de modelarla y de disfrutar con el barro y sus capacidades.
                    </p>
                </div>
                <div class="col-12 col-md-4">
                    <img src="<?= RUTA ?>web/img/ceramicamanual.png" alt="torno" width="100%">
                </div>
            </div>
        </div>


        <div class="row text-start">
            <div class="col-12">
                <h2>Mosaico</h2>
            </div>
        </div>


        <div class="row text-end">
            <div class="col-12">
                <h2>Decoración y cuerda seca</h2>
            </div>
        </div>

    </section>
    <div class="row text-center">
        <div class="col-12">
            <h2>Técnicas</h2>
        </div>
    </div>
    <section class="row text-center">
        <div class="col-12">
            <p>
                En esta sección encontrarás toda la información sobre las técnicas que utilizamos en nuestras clases.
            </p>
        </div>
    </section>
    <section class="vh-50">
        <div class="container py-5 h-auto">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-5">

                    <figure class="bg-light p-4" style="border-left: .35rem solid #fcdb5e; border-top: 1px solid #eee; border-right: 1px solid #eee; border-bottom: 1px solid #eee;">
                        <i class="fas fa-quote-left fa-2x mb-4" style="color: #fcdb5e;"></i>
                        <blockquote class="blockquote pb-2">
                            <p>
                                El alma de la cerámica es el barro, el agua y el fuego. <br>
                                La belleza, la gracia y el arte los pone el alfarero.
                            </p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0">
                            Ramón Soriano Parra. <cite title="Source Title">Fundador de Cerámica Tejares</cite>
                        </figcaption>
                    </figure>

                </div>
            </div>
        </div>
    </section>
    <section class="row text-center">
        <div class="col-12">
            <h2>Actividades</h2>
        </div>
    </section>
    <section class="row text-center">
        <div class="col-12 ">
            <p>
                En esta sección encontrarás toda la información sobre las actividades que llevamos a cabo en nuestro taller.
            </p>
        </div>
    </section>

</article>
<?php
$contenido = ob_get_clean();

require 'template.php';
?>