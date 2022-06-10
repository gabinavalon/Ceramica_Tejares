<?php
ob_start();
?>
<?php MensajesFlash::imprimir_mensajes(); ?>

<article class="container">

    <section class="row text-center">
        <div class="col-12">
            <h1 id="inicio">Técnicas y Actividades</h1>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <br>
                <p>
                    En esta sección encontrarás toda la información sobre las <a href="#tecnicas" style="font-size: 120%;">técnicas</a> y <a href="#actividades" style="font-size: 120%;">actividades</a> que utilizamos en nuestro taller.
                </p>
            </div>
        </div>
        <br><br><br>
        <div class="col-12">
            <h1 id="tecnicas">Técnicas </h1>
        </div>
        <div class="container text-start h-auto">

            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= RUTA ?>web/img/torno.png" class="card-img" alt="Fases del Torneado">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">Torno</h2>
                            <br>
                            <p class="card-text">El torno es la herramienta con la que trabajamos que más simboliza al ceramista. <br> <br>
                                El torneado se utiliza para aprovechar la fuerza de rotación con la maña y fuerza del alfarero,
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
                            <br>
                            <p class="card-text">
                                Todas las piezas tienen que pasar por las manos del artista, se hayan hecho a torno o no. Perfilar, alisar, pulir detalles..
                                Y después están las piezas que de principio a final están hechas a mano. <br><br>
                                Estas piezas pueden ser de cualquier tamaño, o forma, el límite lo marca la imaginación y las posibilidades del barro.
                                <br>
                                Las principales técnicas es mediante churros, es decir, utilizar rollos de barro para crear estructuras, y las planchas, similar pero con planchas de barro en vez de churros. <br><br>
                                El artista tiene total libertad de crear su pieza, de modelarla y de disfrutar con el barro y sus capacidades.
                            </p>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= RUTA ?>web/img/ceramicamanual.png" class="card-img" alt="Cerámica manual">
                    </div>
                </div>
            </div>
        </div>

        <section class="vh-50">
            <div class="container py-5 h-auto">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-12 col-xl-6">

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
        <div class="container text-start h-auto">

            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= RUTA ?>web/img/tecnicamosaico.png" class="card-img" alt="Técnicas de mosaico">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">Mosaico</h2>
                            <br>
                            <p class="card-text">
                                Después de haber estudiado la manera de realizar los mosaicos en la época romana, nosotros la hemos adaptado a la cerámica. Hacemos nuestras propias teselas y realizamos los mosaicos como se hacía en esa época. <br><br>
                                Estas teselas, pequeños cubitos de barro, son coloreados para utilizar la misma gama de colores que se utilizaba durante la época de referencia. <br><br>
                                Es un proceso que requiere mucha, muchísima paciencia, pero el resultado es impresionante.
                            </p>

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
                            <h2 class="card-title">Decoración y cuerda seca</h2>
                            <br>
                            <p class="card-text">
                                Todas las piezas requieren pasar por un proceso de decoración tras su realización, ya sea en torno o modelado a mano. <br><br>
                                Para ello contamos con gran variedad de técnicas, pigmentos, pinturas... A destacar tenemos la cuerda seca, un estilo de pintura que se lleva a cabo con pigmentos mezclados con agua. <br><br>
                                Este proceso no se verá completado hasta que la pieza pase por el horno, donde se solidificará y cambiará los colores. <br>
                                Esta es solo una de las técnicas de decoración que utilizamos, aprenderás muchas otras y tendrás la libertad de improvisar.
                            </p>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= RUTA ?>web/img/tecnicadecoracion.png" class="card-img" alt="Cerámica manual">
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <h5><a href="#inicio">Volver a inicio de página</a> </h5>
        </div>

    </section>
    <div class="row text-center">
        <div class="col-12">
            <h2 id="actividades">Actividades</h2>
        </div>
    </div>
    <section class="row text-center">
        <div class="col-12">
            <p>
                En esta sección encontrarás toda la información sobre las técnicas que utilizamos en nuestras clases.
            </p>
        </div>
    </section>
    <div class="container text-start h-auto">

        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= RUTA ?>web/img/cursoceramica.png" class="card-img" alt="Cursos de cerámica">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">Cursos de Cerámica y Mosaico</h2>
                        <br>
                        <p class="card-text">
                            En nuestro taller impartimos dos cursos principales. El curso de mosaico y el curso de cerámica. <br><br>

                            En el <b> curso de mosaico </b> se te facilitarán los materiales pare realizar tu propio mosaico al puro estilo de la antigua Roma. 
                            Podemos darte un diseño real de un mosaico romano, o probar con una idea tuya. Con paciencia y nuestra ayuda, tendrás en tu casa tu propio mosaico, ¡hecho por ti! <br><br>

                            ¿Quieres aprender a usar el torno? ¿O tal vez prefieres hacerte un juego de café con tus propias manos? En el <b> curso de cerámica </b> podrás probar todas nuestras técnicas y aprender a realizar tus propias obras con nuestra ayuda y total libertad.

                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="row no-gutters">
      
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">Visitas al taller</h2>
                        <br>
                        <p class="card-text">
                            ¿Quieres visitar nuestro taller? <br>
                            Nuestro taller está abierto todas las tardes de lunes a viernes, puedes pasar cuando quiera a ver nuestra tienda, pero si te interesa vivir una experiencia en grupo
                            y ver como funciona un taller de cerámica, ponte en contacto con nosotros para organizar una visita. <br><br>
                            Los tornos, los hornos, las teseletas, decenas de frascos con pigmentos... Todo acompañado de demostraciones en vivo de como trabajamos.
                            ¿Quién sabe? ¡Lo mismo esto te anima a apuntarte a nuestras clases! <br><br>

                            Recuerda que si te pones en contacto con nosotros puedes <a href="<?= RUTA ?>ver_articulo/7"> regalar esta experiencia grupal.</a> ¡Perfecto para un regalo de cumpleaños!
                        </p>

                    </div>
                </div>
                <div class="col-md-4">
                    <img src="<?= RUTA ?>web/img/visitas.png" class="card-img" alt="Visitas al taller">
                </div>
            </div>
        </div>
    </div>

</article>
<?php
$contenido = ob_get_clean();

require 'template.php';
?>