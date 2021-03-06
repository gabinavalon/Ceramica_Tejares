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
require '../app/model/Comentario.php';
require '../app/model/ComentarioDAO.php';
require '../app/model/Like.php';
require '../app/model/LikeDAO.php';
require '../app/model/Contacto.php';
require '../app/model/ContactoDAO.php';
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
    'tecnicas' => array('controlador' => 'ControladorGeneral', 'metodo' => 'tecnicas', 'publica' => true, 'admin' => false),
    'contacto' => array('controlador' => 'ControladorGeneral', 'metodo' => 'contacto', 'publica' => true, 'admin' => false),

    'noticias' => array('controlador' => 'ControladorNoticia', 'metodo' => 'listar_noticias', 'publica' => true, 'admin' => false),
    'ver_noticia' => array('controlador' => 'ControladorNoticia', 'metodo' => 'ver_noticia', 'publica' => true, 'admin' => false),
    'insertar_comentario' => array('controlador' => 'ControladorNoticia', 'metodo' => 'insertar_comentario', 'publica' => false,  'admin' => false),
    'borrar_comentario' => array('controlador' => 'ControladorNoticia', 'metodo' => 'borrar_comentario', 'publica' => false,  'admin' => false),

    'ver_articulo' => array('controlador' => 'ControladorArticulo', 'metodo' => 'ver_articulo', 'publica' => true, 'admin' => false),
    'catalogo' => array('controlador' => 'ControladorArticulo', 'metodo' => 'listar', 'publica' => true, 'admin' => false),
    'reservar' => array('controlador' => 'ControladorArticulo', 'metodo' => 'comprar', 'publica' => false, 'admin' => false),
    'mis_compras' => array('controlador' => 'ControladorArticulo', 'metodo' => 'mis_compras', 'publica' => false, 'admin' => false),
    'like' => array('controlador' => 'ControladorArticulo', 'metodo' => 'like', 'publica' => true, 'admin' => false),


    'admin' => array('controlador' => 'ControladorAdmin', 'metodo' => 'admin', 'publica' => false, 'admin' => true),
    'admin_usuarios' => array('controlador' => 'ControladorAdmin', 'metodo' => 'admin_usuarios', 'publica' => false, 'admin' => true),
    'admin_articulos' => array('controlador' => 'ControladorAdmin', 'metodo' => 'admin_articulos', 'publica' => false, 'admin' => true),
    'admin_noticias' => array('controlador' => 'ControladorAdmin', 'metodo' => 'admin_noticias', 'publica' => false, 'admin' => true),

    'ver_contacto' => array('controlador' => 'ControladorAdmin', 'metodo' => 'ver_contacto', 'publica' => false, 'admin' => true),
    'borrar_contacto' => array('controlador' => 'ControladorAdmin', 'metodo' => 'borrar_contacto', 'publica' => false, 'admin' => true),

    
    'borrar_articulo' => array('controlador' => 'ControladorAdmin', 'metodo' => 'borrar_articulo', 'publica' => false, 'admin' => true),
    'insertar_articulo' => array('controlador' => 'ControladorAdmin', 'metodo' => 'insertar_articulo', 'publica' => false, 'admin' => true),
    'editar_articulo' => array('controlador' => 'ControladorAdmin', 'metodo' => 'editar_articulo', 'publica' => false, 'admin' => true),

    'insertar_noticia' => array('controlador' => 'ControladorAdmin', 'metodo' => 'insertar_noticia', 'publica' => false, 'admin' => true),
    'borrar_noticia' => array('controlador' => 'ControladorAdmin', 'metodo' => 'borrar_noticia', 'publica' => false, 'admin' => true),
    'editar_noticia' => array('controlador' => 'ControladorAdmin', 'metodo' => 'editar_noticia', 'publica' => false, 'admin' => true),

    'borrar_usuario' => array('controlador' => 'ControladorAdmin', 'metodo' => 'borrar_usuario', 'publica' => false, 'admin' => true),
    'editar_usuario' => array('controlador' => 'ControladorAdmin', 'metodo' => 'editar_usuario', 'publica' => false, 'admin' => true),




);

//Parseo de la ruta
if (!empty($_GET['accion'])) {
    if (isset($mapa[$_GET['accion']])) {  //Si existe en el mapa
        $accion = $_GET['accion'];
    } else { //Si no existe en el mapa
        MensajesFlash::anadir_mensaje("La p??gina que buscas no existe.");
        header('Location: ' . RUTA);
        die();
    }
} else {    //Si no me pasan par??metro acci??n, cargo la acci??n por defecto
    $accion = "inicio";
}

//Inicio de sesi??n autom??tico si se encuentra una cookie
if (isset($_COOKIE['uid']) && Sesion::existe() == false) { //Si existe la cookie lo identificamos
    $uid = filter_var($_COOKIE['uid'], FILTER_SANITIZE_SPECIAL_CHARS);
    $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
    $usuario = $usuarioDAO->findByCookie_id($uid);
    if ($usuario != false) {   //Si existe un usuario con la cookie iniciamos sesi??n
        Sesion::iniciar($usuario);
    }
}

//Si va a acceder a una p??gina que no es p??blica y no est?? identificado lo echamos a index
if ($mapa[$accion]['publica'] == false) { //Debe tener la sesi??n iniciada
    if (!Sesion::existe()) {
        MensajesFlash::anadir_mensaje("Debes iniciar sesi??n para acceder a esta p??gina");
        header('Location: ' . RUTA);
        die();
    }
}

//Si va a acceder a una p??gina de administraci??n sin tener este rol
if ($mapa[$accion]['admin'] == true) { //Debe ser administrador
    if (!Sesion::existe()) {
        MensajesFlash::anadir_mensaje("Debes iniciar sesi??n para acceder a esta p??gina");
        header('Location: ' . RUTA);
        die();
    } else {
        if (Sesion::obtener()->getRol() != "admin") {
            MensajesFlash::anadir_mensaje("No tienes permisos para acceder a esta p??gina");
            header('Location: ' . RUTA);
            die();
        }
    }
}


//Ejecuci??n del controlador
$controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

$controlador = new $controlador();
$controlador->$metodo();
