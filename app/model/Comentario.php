<?php

class Comentario{
    private $id;
    private $texto;
    private $id_noticia;
    private $id_usuario;
    private $fecha;

    private $noticia;
    private $usuario;

    function getId() {
        return $this->id;
    }

    function getTexto() {
        return $this->texto;
    }

    function getid_noticia() {
        return $this->id_noticia;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getFecha() {
        return $this->fecha;
    }
    

    function setId($id): void {
        $this->id = $id;
    }

    function setTexto($texto): void {
        $this->texto = $texto;
    }

    function setid_noticia($id_noticia): void {
        $this->id_noticia = $id_noticia;
    }

    function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    function getUser() {
        if (!isset($this->usuario)) {
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            $this->usuario = $usuarioDAO->find($this->getId_usuario());
        }
        return $this->usuario;
    }

    function getNoticia() {
        if (!isset($this->noticia)) {
            $noticiaDAO = new NoticiaDAO(ConexionBD::conectar());
            $this->noticia = $noticiaDAO->find($this->getid_noticia());
        }
        return $this->noticia;
    }

}