<?php


class ControladorAdmin{


    // Funciones generales

    public function admin(){
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

        if($usuario->getRol() == 'admin'){

            require '../app/templates/administracion.php';
        }else{
            
            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    public function admin_noticias(){
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

         //Generamos Token para seguridad del borrado
         $_SESSION['token'] = md5(time() + rand(0, 999));
         $token = $_SESSION['token'];

        if($usuario->getRol() == 'admin'){

            $noticiaDAO = new NoticiaDAO($conn);
            $noticias = $noticiaDAO->findAll();

            require '../app/templates/administracion_noticias.php';
        }else{
            
            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    public function admin_usuarios(){
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

         //Generamos Token para seguridad del borrado
         $_SESSION['token'] = md5(time() + rand(0, 999));
         $token = $_SESSION['token'];

        if($usuario->getRol() == 'admin'){

            $usuarioDAO = new UsuarioDAO($conn);
            $usuarios = $usuarioDAO->findAll();

            require '../app/templates/administracion_usuarios.php';
        }else{
            
            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    public function admin_articulos(){
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

         //Generamos Token para seguridad del borrado
         $_SESSION['token'] = md5(time() + rand(0, 999));
         $token = $_SESSION['token'];

        if($usuario->getRol() == 'admin'){

            $articuloDAO = new ArticuloDAO($conn);
            $articulos = $articuloDAO->findAll();


            require '../app/templates/administracion_articulos.php';
        }else{
            
            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    // funciones de usuario

    public function borrar_usuario(){

        if ($_GET['t'] != $_SESSION['token']) {
            header("Location: " . RUTA . "admin_usuarios");
            MensajesFlash::anadir_mensaje("El token no es correcto");
            die();
        }

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $usuario = $usuarioDAO->find($id);
   
            if ($usuarioDAO->delete($usuario)) {
                MensajesFlash::anadir_mensaje("Usuario borrado");
            } else {
                MensajesFlash::anadir_mensaje("Usuario no encontrado");
            }
  
            header("Location: " . RUTA . "admin_usuarios");
    }


    // funciones de noticias

    public function borrar_noticia(){

        if ($_GET['t'] != $_SESSION['token']) {
            header("Location: " . RUTA . "admin_noticias");
            MensajesFlash::anadir_mensaje("El token no es correcto");
            die();
        }

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $noticiaDAO = new NoticiaDAO(ConexionBD::conectar());
        $noticia = $noticiaDAO->find($id);
   
            if ($noticiaDAO->delete($noticia)) {
                MensajesFlash::anadir_mensaje("Noticia borrada");
            } else {
                MensajesFlash::anadir_mensaje("Noticia no encontrada");
            }
  
            header("Location: " . RUTA . "admin_noticias");
    }

    // funciones de articulos

    public function borrar_articulo(){

        if ($_GET['t'] != $_SESSION['token']) {
            header("Location: " . RUTA . "admin_articulos");
            MensajesFlash::anadir_mensaje("El token no es correcto");
            die();
        }

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
        $articulo = $articuloDAO->find($id);
   
            if ($articuloDAO->delete($articulo)) {
                MensajesFlash::anadir_mensaje("Articulo borrado");
            } else {
                MensajesFlash::anadir_mensaje("Articulo no encontrado");
            }
  
            header("Location: " . RUTA . "admin_articulos");

        }
        
    
}