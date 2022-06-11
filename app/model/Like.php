<?php

class Like{
    private $id;
    private $id_articulo;
    private $id_usuario;

    private $articulo;
    private $usuario;

    function getId() {
        return $this->id;
    }

    function getId_articulo() {
        return $this->id_articulo;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setId_articulo($id_articulo): void {
        $this->id_articulo = $id_articulo;
    }

    function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    function getUsuario() {
        if (!isset($this->usuario)) {
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            $this->usuario = $usuarioDAO->find($this->getId_usuario());
        }
        return $this->usuario;
    }

    function getArticulo() {
        if (!isset($this->articulo)) {
            $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
            $this->articulo = $articuloDAO->find($this->getId_articulo());
        }
        return $this->articulo;
    }

}