<?php

class ControladorArticulo{

    public function ver_articulo() {

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $conn = ConexionBD::conectar();
        //Buscamos el artículo en la BBDD
        $articuloDAO = new ArticuloDAO($conn);
        $articulo = $articuloDAO->find($id);
        
        //$comentarioDAO = new ComentarioDAO($conn);
        //$comentarios = $comentarioDAO->findbyArticulo($id);

        require '../app/templates/ver_articulo.php';
    }

    public function listar(){

        $conn = ConexionBD::conectar();
        $articuloDAO = new ArticuloDAO($conn);
        $articulos = $articuloDAO->findAll();

        require '../app/templates/catalogo.php';
    }
}