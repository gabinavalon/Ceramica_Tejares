<?php

class ControladorGeneral{

    public function listar(){


        $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
        $articulos = $articuloDAO->findAll('DESC', 'fecha');
        $noticiaDAO = new NoticiaDAO(ConexionBD::conectar());
        $noticias = $noticiaDAO->findAll('ASC', 'fecha');

        //Mostramos las tres noticias más recientes
        $n1 = $noticias[0];
        $n2 = $noticias[1];
        $n3 = $noticias[2];

        //Mostramos los seis últimos artículos
        $ultimosArticulos = array();
        for ($i = 0; $i < 6; $i++) {
            $ultimosArticulos[] = $articulos[$i];
        } 

        $likeDAO = new LikeDAO(ConexionBD::conectar());
        $likes = $likeDAO->findAll();

        require '../app/templates/inicio.php';
    }

    public function tecnicas(){

        require '../app/templates/tecnicasyactividades.php';
    }

}