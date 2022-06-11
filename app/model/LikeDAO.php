<?php

class LikeDAO{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function findAll() {
        $sql = "SELECT * FROM likes";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_likes = array();
        while ($like = $result->fetch_object('Like')) {
            $array_obj_likes[] = $like;
        }
        return $array_obj_likes;
    }

    public function findByArticulo($id_articulo){
        $sql = "SELECT * FROM likes WHERE id_articulo = $id_articulo";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_likes = array();
        while ($like = $result->fetch_object('Like')) {
            $array_obj_likes[] = $like;
        }
        return $array_obj_likes;
    }

    public function findByUsuario($id_usuario){
        $sql = "SELECT * FROM likes WHERE id_usuario = $id_usuario";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_likes = array();
        while ($like = $result->fetch_object('Like')) {
            $array_obj_likes[] = $like;
        }
        return $array_obj_likes;
    }
}