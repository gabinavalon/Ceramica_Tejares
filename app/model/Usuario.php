<?php

/**
 * Clase usuario
 *
 * @author Gabriel Navalón Soriano
 */
class Usuario {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $telefono;
    private $foto;
    private $cookie_id;
    private $rol;
       
    //Array que va a contener los artículos de este usuario
    private $articulos;
    
    
    function getCookie_id() {
        return $this->cookie_id;
    }

    function setCookie_id($cookie_id): void {
        $this->cookie_id = $cookie_id;
    }

        function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getFoto() {
        return $this->foto;
    }

    function getArticulos() {
        return $this->articulos;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setFoto($foto): void {
        $this->foto = $foto;
    }

    function setArticulos($articulos): void {
        $this->articulos = $articulos;
    }
    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }
    
    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol): void {
        $this->rol = $rol;
    }





}
