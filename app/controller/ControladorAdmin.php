<?php


class ControladorAdmin
{


    // Funciones generales

    public function admin()
    {
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

              //Generamos Token para seguridad del borrado
              $_SESSION['token'] = md5(time() + rand(0, 999));
              $token = $_SESSION['token'];

        if ($usuario->getRol() == 'admin') {

            $contactoDAO = new ContactoDAO($conn);
            $contactos = $contactoDAO->findAll();

            require '../app/templates/administracion.php';
        } else {

            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    public function admin_noticias()
    {
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

        //Generamos Token para seguridad del borrado
        $_SESSION['token'] = md5(time() + rand(0, 999));
        $token = $_SESSION['token'];

        if ($usuario->getRol() == 'admin') {

            $noticiaDAO = new NoticiaDAO($conn);
            $noticias = $noticiaDAO->findAll();

            require '../app/templates/administracion_noticias.php';
        } else {

            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    public function admin_usuarios()
    {
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

        //Generamos Token para seguridad del borrado
        $_SESSION['token'] = md5(time() + rand(0, 999));
        $token = $_SESSION['token'];

        if ($usuario->getRol() == 'admin') {

            $usuarioDAO = new UsuarioDAO($conn);
            $usuarios = $usuarioDAO->findAll();

            require '../app/templates/administracion_usuarios.php';
        } else {

            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    public function admin_articulos()
    {
        $usuario = Sesion::obtener();
        $conn = ConexionBD::conectar();

        //Generamos Token para seguridad del borrado
        $_SESSION['token'] = md5(time() + rand(0, 999));
        $token = $_SESSION['token'];

        if ($usuario->getRol() == 'admin') {

            $articuloDAO = new ArticuloDAO($conn);
            $articulos = $articuloDAO->findAll();


            require '../app/templates/administracion_articulos.php';
        } else {

            MensajesFlash::anadir_mensaje("No tiene permisos para acceder a esta página.");

            require '../app/templates/login.php';

            die();
        }
    }

    // funciones de usuario

    public function borrar_usuario()
    {

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

    public function editar_usuario()
    {
        if (Sesion::existe() == false) {

            header("Location: " . RUTA);
            MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
            die();
        } else {
            if (Sesion::obtener()->getRol() != 'admin') {

                header("Location: " . RUTA);
                MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
                die();
            }
        }

        $usuarioDAO = new UsuarioDAO(ConexionBD::conectar());
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $usuario = $usuarioDAO->find($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        }

        $gestion = "usuarios";
        require '../app/templates/gestion.php';

    }

    // funciones de noticias

    public function borrar_noticia()
    {

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

    function insertar_noticia()
    {

        if (Sesion::existe() == false) {

            header("Location: " . RUTA);
            MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
            die();
        } else {
            if (Sesion::obtener()->getRol() != 'admin') {

                header("Location: " . RUTA);
                MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
                die();
            }
        }



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $conn = ConexionBD::conectar();
            //Insertamos la noticia en la BBDD
            $noticiaDAO = new NoticiaDAO($conn);
            $noticia = new Noticia();

            //Filtramos datos de entrada
            $descripcion = filter_var($_POST['descripcion_noticia'], FILTER_SANITIZE_SPECIAL_CHARS);
            $titulo = filter_var($_POST['titulo_noticia'], FILTER_SANITIZE_SPECIAL_CHARS);

            $noticia->setDescripcion($descripcion);
            $noticia->setTitulo($titulo);


            $noticiaDAO->insert($noticia);

            //Validación de la foto
                $error = false;

                if (
                    $_FILES['foto_noticia']['type']!= 'image/png' &&
                    $_FILES['foto_noticia']['type']!= 'image/gif' &&
                    $_FILES['foto_noticia']['type']!= 'image/jpeg'
                ) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado no es una foto.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }
                if ($_FILES['foto']['size'] > 100000000) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado es demasiado grande.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }

                if (!$error) {

                    $nombre_foto = md5(time() + rand(0, 999999));
                    $extension_foto = substr($_FILES['foto_noticia']['name'], strrpos($_FILES['foto_noticia']['name'], '.') + 1);
                    //Limpiamos la extensión de la foto
                    $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                    //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                    while (file_exists("img/noticias/$nombre_foto.$extension_foto")) {
                        $nombre_foto = md5(time() + rand(0, 999999));
                    }
                    //movemos la foto a la carpeta que queramos guardarla y con el nuevo nombre
                    
                    move_uploaded_file($_FILES['foto_noticia']['tmp_name'],"img/noticias/$nombre_foto.$extension_foto");

 
                    $nombre_archivo = "$nombre_foto.$extension_foto";
                    $noticia->setFoto($nombre_archivo);

                    if (!$noticiaDAO->update($noticia)) {
                        die("Error al insertar la foto en la BD");
                    }
                } //if(!$error)

            MensajesFlash::anadir_mensaje("Se ha insertado la noticia correctamente");
            header("Location: " . RUTA . "admin_noticias");
            die();
        }

        $gestion = "noticias";

        require '../app/templates/gestion.php';
    }

    function editar_noticia()
    {

        if (Sesion::existe() == false) {

            header("Location: " . RUTA);
            MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
            die();
        } else {
            if (Sesion::obtener()->getRol() != 'admin') {

                header("Location: " . RUTA);
                MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
                die();
            }
        }

        $noticiaDAO = new NoticiaDAO(ConexionBD::conectar());
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $noticia = $noticiaDAO->find($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $conn = ConexionBD::conectar();
            //Insertamos la noticia en la BBDD

            $noticiaNueva = new Noticia();

            //Filtramos datos de entrada
            $descripcion = filter_var($_POST['descripcion_noticia'], FILTER_SANITIZE_SPECIAL_CHARS);
            $titulo = filter_var($_POST['titulo_noticia'], FILTER_SANITIZE_SPECIAL_CHARS);

            $noticiaNueva->setDescripcion($descripcion);
            $noticiaNueva->setTitulo($titulo);
            $noticiaNueva->setId($id);

            $noticiaDAO->update($noticiaNueva);

            //Validación de la foto
                $error = false;

                if (
                    $_FILES['foto_noticia']['type']!= 'image/png' &&
                    $_FILES['foto_noticia']['type']!= 'image/gif' &&
                    $_FILES['foto_noticia']['type']!= 'image/jpeg'
                ) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado no es una foto.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }
                if ($_FILES['foto']['size'] > 100000000) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado es demasiado grande.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }

                if (!$error) {

                    $nombre_foto = md5(time() + rand(0, 999999));
                    $extension_foto = substr($_FILES['foto_noticia']['name'], strrpos($_FILES['foto_noticia']['name'], '.') + 1);
                    //Limpiamos la extensión de la foto
                    $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                    //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                    while (file_exists("img/noticias/$nombre_foto.$extension_foto")) {
                        $nombre_foto = md5(time() + rand(0, 999999));
                    }
                    //movemos la foto a la carpeta que queramos guardarla y con el nuevo nombre
                    
                    move_uploaded_file($_FILES['foto_noticia']['tmp_name'],"img/noticias/$nombre_foto.$extension_foto");

 
                    $nombre_archivo = "$nombre_foto.$extension_foto";
                    $noticiaNueva->setFoto($nombre_archivo);

                    if (!$noticiaDAO->update($noticiaNueva)) {
                        die("Error al insertar la foto en la BD");
                    }
                } //if(!$error)

            MensajesFlash::anadir_mensaje("Se ha editado la noticia correctamente");
            header("Location: " . RUTA . "admin_noticias");
            die();


        }

        
        $gestion = "noticias";
        require '../app/templates/gestion.php';
    }



    // funciones de articulos

    public function borrar_articulo()
    {

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

    function insertar_articulo()
    {

        if (Sesion::existe() == false) {

            header("Location: " . RUTA);
            MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
            die();
        } else {
            if (Sesion::obtener()->getRol() != 'admin') {

                header("Location: " . RUTA);
                MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
                die();
            }
        }



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $conn = ConexionBD::conectar();
            //Insertamos la noticia en la BBDD
            $articuloDAO = new ArticuloDAO($conn);
            $articulo = new Articulo();

            //Filtramos datos de entrada
            $descripcion = filter_var($_POST['descripcion_articulo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $titulo = filter_var($_POST['titulo_articulo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $precio = filter_var($_POST['precio_articulo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $disponible = filter_var($_POST['disponible'], FILTER_SANITIZE_SPECIAL_CHARS);


            $articulo->setDescripcion($descripcion);
            $articulo->setTitulo($titulo);
            $articulo->setPrecio($precio);
            $articulo->setLikes(0);
            $articulo->setReservado($disponible);



            $articuloDAO->insert($articulo);

            

            //Validación de la foto
                $error = false;

                if (
                    $_FILES['foto_articulo']['type']!= 'image/png' &&
                    $_FILES['foto_articulo']['type']!= 'image/gif' &&
                    $_FILES['foto_articulo']['type']!= 'image/jpeg'
                ) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado no es una foto.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }
                if ($_FILES['foto_articulo']['size'] > 100000000) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado es demasiado grande.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }

                if (!$error) {

                    $nombre_foto = md5(time() + rand(0, 999999));
                    $extension_foto = substr($_FILES['foto_articulo']['name'], strrpos($_FILES['foto_articulo']['name'], '.') + 1);
                    //Limpiamos la extensión de la foto
                    $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                    //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                    while (file_exists("img/articulos/$nombre_foto.$extension_foto")) {
                        $nombre_foto = md5(time() + rand(0, 999999));
                    }
                    //movemos la foto a la carpeta que queramos guardarla y con el nuevo nombre
                    
                    move_uploaded_file($_FILES['foto_articulo']['tmp_name'],"img/articulos/$nombre_foto.$extension_foto");

 
                    $nombre_archivo = "$nombre_foto.$extension_foto";

                    $articulo->setFoto($nombre_archivo);

                    if (!$articuloDAO->update($articulo)) {
                        die("Error al insertar la foto en la BD");
                    }

                } //if(!$error)

            MensajesFlash::anadir_mensaje("Se ha insertad el articulo correctamente");
            header("Location: " . RUTA . "admin_articulos");
            die();
        }

        $gestion = "articulos";

        require '../app/templates/gestion.php';
    }

    function editar_articulo()
    {

        if (Sesion::existe() == false) {

            header("Location: " . RUTA);
            MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
            die();
        } else {
            if (Sesion::obtener()->getRol() != 'admin') {

                header("Location: " . RUTA);
                MensajesFlash::anadir_mensaje("Debes iniciar sesión para acceder a esta página y ser administrador.");
                die();
            }
        }

        $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $articulo = $articuloDAO->find($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $conn = ConexionBD::conectar();
            //Insertamos la noticia en la BBDD

            $articuloNuevo = new Articulo();

            //Filtramos datos de entrada
            $descripcion = filter_var($_POST['descripcion_articulo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $titulo = filter_var($_POST['titulo_articulo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $precio = filter_var($_POST['precio_articulo'], FILTER_SANITIZE_SPECIAL_CHARS);
            $disponible = filter_var($_POST['disponible'], FILTER_SANITIZE_SPECIAL_CHARS);

            $articuloNuevo->setDescripcion($descripcion);
            $articuloNuevo->setTitulo($titulo);
            $articuloNuevo->setPrecio($precio);
            $articuloNuevo->setReservado($disponible);

            $articuloNuevo->setId($id);

            $articuloDAO->update($articuloNuevo);

            //Validación de la foto
                $error = false;

                if (
                    $_FILES['foto_articulo']['type']!= 'image/png' &&
                    $_FILES['foto_articulo']['type']!= 'image/gif' &&
                    $_FILES['foto_articulo']['type']!= 'image/jpeg'
                ) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado no es una foto.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }
                if ($_FILES['foto']['size'] > 100000000) {
                    MensajesFlash::anadir_mensaje("El archivo seleccionado es demasiado grande.");
                    $error = true;
                    header("Location: " . RUTA);
                    die();
                }

                if (!$error) {

                    $nombre_foto = md5(time() + rand(0, 999999));
                    $extension_foto = substr($_FILES['foto_articulo']['name'], strrpos($_FILES['foto_articulo']['name'], '.') + 1);
                    //Limpiamos la extensión de la foto
                    $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                    //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                    while (file_exists("img/articulos/$nombre_foto.$extension_foto")) {
                        $nombre_foto = md5(time() + rand(0, 999999));
                    }
                    //movemos la foto a la carpeta que queramos guardarla y con el nuevo nombre
                    
                    move_uploaded_file($_FILES['foto_articulo']['tmp_name'],"img/articulos/$nombre_foto.$extension_foto");

 
                    $nombre_archivo = "$nombre_foto.$extension_foto";
                    $articuloNuevo->setFoto($nombre_archivo);

                    if (!$articuloDAO->update($articuloNuevo)) {
                        die("Error al insertar la foto en la BD");
                    }
                } //if(!$error)

            MensajesFlash::anadir_mensaje("Se ha modificado el articulo correctamente");
            header("Location: " . RUTA . "admin_articulos");
            die();


        }

        
        $gestion = "articulos";
        require '../app/templates/gestion.php';
    }

    //Funciones de contacto

    function ver_contacto(){

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $contactoDAO = new ContactoDAO(ConexionBD::conectar());
        $contacto = $contactoDAO->find($id);

        $contacto->setLeído(1);

        $contactoDAO->update($contacto);

        require '../app/templates/ver_contacto.php';

    }

    public function borrar_contacto()
    {

        if ($_GET['t'] != $_SESSION['token']) {
            header("Location: " . RUTA . "admin_articulos");
            MensajesFlash::anadir_mensaje("El token no es correcto");
            die();
        }

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $contactoDAO = new ContactoDAO(ConexionBD::conectar());
        $contacto = $contactoDAO->find($id);

        if ($contactoDAO->delete($contacto)) {
            MensajesFlash::anadir_mensaje("Contacto borrado");
        } else {
            MensajesFlash::anadir_mensaje("Contacto no encontrado");
        }

        header("Location: " . RUTA . "admin");
    }


}
