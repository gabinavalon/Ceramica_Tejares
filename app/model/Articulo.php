<?php

/**
 * Description of Articulo
 *
 * @author Gabriel Navalón Soriano
 */
class Articulo {

    private $id;
    private $titulo;
    private $descripcion;
    private $precio;
    private $fecha;
    private $reservado;
    private $foto;

    private $likes;
   

    

    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    function getLikes() {
        return $this->likes;
    }

    function setLikes($likes): void {
        $this->likes = $likes;
    }



    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getReservado() {
        return $this->reservado;
    }

    function getFoto() {
        return $this->foto;
    }




    function setId($id): void {
        $this->id = $id;
    }

    function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio): void {
        $this->precio = $precio;
    }

    function setReservado($reservado): void {
        $this->reservado = $reservado;
    }

    function setFoto($foto): void {
        $this->foto = $foto;
    }


}
