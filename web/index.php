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
require '../app/controller/ControladorArticulo.php';
require '../app/controller/ControladorUsuario.php';
require '../app/controller/ControladorAdmin.php';
require '../app/controller/ControladorNoticia.php';
require '../app/controller/ControladorGeneral.php';
require '../app/config.php';


//Enrutamiento
$mapa = array(
    'registrar' => array('controlador' => 'ControladorUsuario', 'metodo' => 'registrar', 'publica' => true, 'admin' => false),
    'login' => array('controlador' => 'ControladorUsuario', 'metodo' => 'login', 'publica' => true, 'admin' => false),
    'logout' => array('controlador' => 'ControladorUsuario', 'metodo' => 'logout', 'publica' => false, 'admin' => false),
    'existe_email' => array('controlador' => 'ControladorUsuario', 'metodo' => 'existe_email', 'publica' => true, 'admin' => false),
    'subir_foto' => array('controlador' => 'ControladorUsuario', 'metodo' => 'subir_foto', 'publica' => false, 'admin' => false),

    'inicio' => array('controlador' => 'ControladorGeneral', 'metodo' => 'listar', 'publica' => true, 'admin' => false),

    'borrar_articulo' => array('controlador' => 'ControladorAdmin', 'metodo' => 'borrar', 'publica' => false, 'admin' => true),
    'insertar_articulo' => array('controlador' => 'ControladorAdmin', 'metodo' => 'insertar', 'publica' => false, 'admin' => true),

    'ver_articulo' => array('controlador' => 'ControladorArticulo', 'metodo' => 'ver_articulo', 'publica' => true, 'admin' => false),
    'reservar' => array('controlador' => 'ControladorArticulo', 'metodo' => 'comprar', 'publica' => false, 'admin' => false),
    'mis_compras' => array('controlador' => 'ControladorArticulo', 'metodo' => 'mis_compras', 'publica' => false, 'admin' => false),
    'like' => array('controlador' => 'ControladorArticulo', 'metodo' => 'like', 'publica' => true, 'admin' => false),

    'insertar_noticia' => array('controlador' => 'ControladorAdmin', 'metodo' => 'insertar', 'publica' => false, 'admin' => true),
    'borrar_noticia' => array('controlador' => 'ControladorAdmin', 'metodo' => 'borrar', 'publica' => false, 'admin' => true),
    'modificar_noticia' => array('controlador' => 'ControladorAdmin', 'metodo' => 'modificar', 'publica' => false, 'admin' => true),
    'ver_noticia' => array('controlador' => 'ControladorAdmin', 'metodo' => 'modificar', 'publica' => false, 'admin' => true),
    'listar_noticias' => array('controlador' => 'ControladorAdmin', 'metodo' => 'modificar', 'publica' => false, 'admin' => true),

);

//Parseo de la ruta
if (!empty($_GET['accion'])) {
    if (isset($mapa[$_GET['accion']])) {  //Si existe en el mapa
        $accion = $_GET['accion'];
    } else { //Si no existe en el mapa
        MensajesFlash::anadir_mensaje("La página que buscas no existe.");
        header('Location: ' . RUTA);
        die();
    }
} else {    //Si no me pasan parámetro acción, cargo la acción por defecto
    $accion = "inicio";
}

//Inicio de sesión automático si se encuentra una cookie
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
        header('Location: ' . RUTA);
        die();
    }
}

//Si va a acceder a una página de administración sin tener este rol
if ($mapa[$accion]['admin'] == true) { //Debe ser administrador
    if (!Sesion::existe()) {
        MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página");
        header('Location: ' . RUTA);
        die();
    }else{
        if(Sesion::obtener()->getRol() != "admin"){
            MensajesFlash::anadir_mensaje("No tienes permisos para acceder a esta página");
            header('Location: ' . RUTA);
            die();
        }
    }
}


//Ejecución del controlador
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

$controlador = new $controlador();
$controlador->$metodo();
