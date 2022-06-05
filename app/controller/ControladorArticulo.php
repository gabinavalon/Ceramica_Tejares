<?php

class ControladorArticulo{

    public function ver() {

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $conn = ConexionBD::conectar();
        //Buscamos el artículo en la BBDD
        $articuloDAO = new ArticuloDAO($conn);
        $articulo = $articuloDAO->find($id);
        
        //$comentarioDAO = new ComentarioDAO($conn);
        //$comentarios = $comentarioDAO->findbyArticulo($id);

        require '../app/templates/ver_articulo.php';
    }
}