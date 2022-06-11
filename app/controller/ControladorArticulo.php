<?php

class ControladorArticulo
{

    public function ver_articulo()
    {

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $conn = ConexionBD::conectar();
        //Buscamos el artículo en la BBDD
        $articuloDAO = new ArticuloDAO($conn);
        $articulo = $articuloDAO->find($id);

        //$comentarioDAO = new ComentarioDAO($conn);
        //$comentarios = $comentarioDAO->findbyArticulo($id);

        require '../app/templates/ver_articulo.php';
    }

    public function listar()
    {

        $conn = ConexionBD::conectar();
        $articuloDAO = new ArticuloDAO($conn);
        $articulos = $articuloDAO->findAll();

        $likeDAO = new LikeDAO($conn);
        $likes = $likeDAO->findAll();

        require '../app/templates/catalogo.php';
    }

    public function like()
    {

        $conn = ConexionBD::conectar();

        if ($conn->connect_error) {
            die("Error al conectar con MySQL: " . $conn->error);
        }

        $articuloDAO = new ArticuloDAO($conn);

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        if (!$articulo = $articuloDAO->find($id)) {
            header("Content-type: application/json");
            echo json_encode(array("resultado" => "error el articulo no existe"));
            die();
        }

        $articulo->setLikes($articulo->getLikes() + 1);

        $articuloDAO->update($articulo);

        header("Content-type: application/json");
        echo json_encode(array(
            "resultado" => 'ok',
            "likes" => $articulo->getLikes()
        ));
    }
}
