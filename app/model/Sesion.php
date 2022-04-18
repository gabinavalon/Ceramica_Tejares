<?php

/**
 * Modelo de manejo de acciones de usuario, inicio de sesión, cierre, y comprobación de si existe el usuario
 *
 * @author Gabriel Navalón Soriano
 */
class Sesion {
    static public function iniciar($usuario){
        $_SESSION['usuario_sesion']= serialize($usuario);
    }
    
    static public function existe() {
        return isset($_SESSION['usuario_sesion']);
    }
    
    static public function cerrar(){
        unset($_SESSION['usuario_sesion']);
    }
    
    /**
     * Devuelve el objeto usuario conectado o false si no ha iniciado sesión
     * @return boolean
     */
    static public function obtener(){
        if(isset($_SESSION['usuario_sesion']))
            return unserialize($_SESSION['usuario_sesion']);
        else
            return false;
    }
}
