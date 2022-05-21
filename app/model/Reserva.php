<?php


/**
 * Description of Reserva
 *
 * @author Gabriel Navalón Soriano
 */
class Reserva {
   
    private $id;
    private $id_usuario;
    private $id_articulo;
    private $fecha;
    //Propiedad para acceder a los datos del usuario que hizo la reserva
    private $usuario;
    //Propiedad para acceder a los datos del artículo reservado
    private $articulo;
    
    
    public function getId() {
        return $this->id;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getId_articulo() {
        return $this->id_articulo;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getUsuario() {
        if (!isset($this->usuario)) {
            $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
            $this->usuario = $usuarioDAO->find($this->getId_usuario());
        }
        return $this->usuario;
    }

    public function getArticulo() {
            if (!isset($this->articulo)) {
            $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
            $this->articulo = $articuloDAO->find($this->getId_articulo());
        }
        return $this->usuario;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    public function setId_articulo($id_articulo): void {
        $this->id_articulo = $id_articulo;
    }

    public function setFecha($fecha): void {
        $this->fecha = $fecha;
    }
    
}
