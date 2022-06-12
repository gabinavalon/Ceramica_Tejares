<?php

class Contacto{
        private $id;
        private $nombre;
        private $email;
        private $texto;
        private $asunto;
        private $fecha;
        private $leído;

        function getId() {
            return $this->id;
        }
        
        function getNombre() {
            return $this->nombre;
        }

        function getEmail() {
            return $this->email;
        }

        function getTexto() {
            return $this->texto;
        }

        function getAsunto() {
            return $this->asunto;
        }

        function getFecha() {
            return $this->fecha;
        }

        function getLeído() {
            return $this->leído;
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

        function setTexto($texto): void {
            $this->texto = $texto;
        }

        function setAsunto($asunto): void {
            $this->asunto = $asunto;
        }

        function setFecha($fecha): void {
            $this->fecha = $fecha;
        }

        function setLeído($leído): void {
            $this->leído = $leído;
        }


        
}