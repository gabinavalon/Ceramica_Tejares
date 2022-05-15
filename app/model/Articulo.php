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
    private $unidades;
   
    private $fotos;

    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }


    function getFotos() {

        if (!isset($this->fotos)) {
            $fotoDAO = new FotoDAO(ConexionBD::conectar());
            $this->fotos = $fotoDAO->findByIdArticulo($this->getId());
        }
        
        return $this->fotos;
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

    function getUnidades() {
        return $this->unidades;
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

    function setUnidades($unidades): void {
        $this->unidades = $unidades;
    }


}