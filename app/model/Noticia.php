<?php

/**
 * Description of Noticia
 *
 * @author Gabriel Navalón Soriano
 */

class Noticia
{
    public $id;
    public $titulo;
    public $descripcion;
    public $fecha;
    public $foto;

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }
}
