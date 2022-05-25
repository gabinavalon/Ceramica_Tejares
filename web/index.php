<?php

/*
 * Controlador Frontal
 */

session_start();

//Requires
require '../app/model/ConexionBD.php';
require '../app/model/Articulo.php';
require '../app/model/ArticuloDAO.php';
require '../app/model/Foto.php';
require '../app/model/FotoDAO.php';
require '../app/model/MensajesFlash.php';
require '../app/model/Sesion.php';
require '../app/model/Usuario.php';
require '../app/model/UsuarioDAO.php';
require '../app/model/Noticia.php';
require '../app/model/NoticiaDAO.php';
require '../app/model/ReservaDAO.php';
require '../app/model/Reserva.php';
/*require '../app/controladores/ControladorArticulo.php';
require '../app/controladores/ControladorUsuario.php';
require '../app/controladores/ControladorComentario.php';
require '../app/config.php';*/


//Enrutamiento
$mapa = array(
    'inicio' => array('controlador' => 'ControladorArticulo', 'metodo' => 'listar', 'publica' => true),
    'borrar_articulo' => array('controlador' => 'ControladorArticulo', 'metodo' => 'borrar', 'publica' => false),
    'insertar_articulo' => array('controlador' => 'ControladorArticulo', 'metodo' => 'insertar', 'publica' => false),
    'ver_articulo' => array('controlador' => 'ControladorArticulo', 'metodo' => 'ver', 'publica' => true),
    'registrar' => array('controlador' => 'ControladorUsuario', 'metodo' => 'registrar', 'publica' => true),
    'subir_foto' => array('controlador' => 'ControladorUsuario', 'metodo' => 'subir_foto', 'publica' => false),
    'login' => array('controlador' => 'ControladorUsuario', 'metodo' => 'login', 'publica' => true),
    'logout' => array('controlador' => 'ControladorUsuario', 'metodo' => 'logout', 'publica' => false),
    'mis_articulos' => array('controlador' => 'ControladorArticulo', 'metodo' => 'mis_articulos', 'publica' => false),
    'comprar' => array('controlador' => 'ControladorArticulo', 'metodo' => 'comprar', 'publica' => false),
    'mis_compras' => array('controlador' => 'ControladorArticulo', 'metodo' => 'mis_compras', 'publica' => false),
    'existe_email' => array('controlador' => 'ControladorUsuario', 'metodo' => 'existe_email', 'publica' => true),
    'like' => array('controlador' => 'ControladorArticulo', 'metodo' => 'like', 'publica' => true),
    'insertar_comentario' => array('controlador' => 'ControladorComentario', 'metodo' => 'insertar', 'publica' => true),
    'borrar_comentario' => array('controlador' => 'ControladorComentario', 'metodo' => 'borrar', 'publica' => true),
    
);

//Parseo de la ruta
if (!empty($_GET['accion'])) {
    if (isset($mapa[$_GET['accion']])) {  //Si existe en el mapa
        $accion = $_GET['accion'];
    } else { //Si no existe en el mapa
        MensajesFlash::anadir_mensaje("La página que buscas no existe.");
        header('Location: '.RUTA);
        die();
    }
} else {    //Si no me pasan parámetro acción, cargo la acción por defecto
    $accion = "inicio";
}

//Si tiene cookie y no ha iniciado sesión, iniciamos sesión automáticamente
if (isset($_COOKIE['uid']) && Sesion::existe() == false) { //Si existe la cookie lo identificamos
    $uid = filter_var($_COOKIE['uid'], FILTER_SANITIZE_SPECIAL_CHARS);
    $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
    $usuario = $usuarioDAO->findByCookie_id($uid);
    if ($usuario != false) {   //Si existe un usuario con la cookie iniciamos sesión
        Sesion::iniciar($usuario);
    }
}

//Si va a acceder a una página que no es pública y no está identificado lo echamos a index
if ($mapa[$accion]['publica'] == false) { //Debe tener la sesión iniciada
    if (!Sesion::existe()) {
        MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página");
        header('Location: '.RUTA);
        die();
    }
}


//Ejecución del controlador
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

$controlador = new $controlador();
$controlador->$metodo();
