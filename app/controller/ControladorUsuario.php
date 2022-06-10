<?php

/**
 * Description of ControladorUsuario
 *
 * @author Gabriel Navalón Soriano
 */

class ControladorUsuario
{

    public function registrar()
    {
        $alert = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Comprobamos el token
            if ($_POST['token'] != $_SESSION['token']) {
                header('Location: index.php');
                MensajesFlash::anadir_mensaje("Token incorrecto");
                $alert = true;
                die();
            }

            $usuario = new Usuario();
            $error = false;
            if (empty($_POST['email'])) {
                MensajesFlash::anadir_mensaje("El email es obligatorio.");
                $error = true;
                $alert = true;
            }
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                MensajesFlash::anadir_mensaje("El email no es correcto.");
                $error = true;
                $alert = true;
            }
            if (empty($_POST['nombre'])) {
                MensajesFlash::anadir_mensaje("Introduzca su nombre, es obligatorio.");
                $error = true;
                $alert = true;
            }
            if (empty($_POST['apellidos'])) {
                MensajesFlash::anadir_mensaje("Introduzca apellido/s, es obligatorio.");
                $error = true;
                $alert = true;
            }

            //Validación foto
            if (
                $_FILES['foto']['type'] != 'image/png' &&
                $_FILES['foto']['type'] != 'image/gif' &&
                $_FILES['foto']['type'] != 'image/jpeg'
            ) {
                MensajesFlash::anadir_mensaje("El archivo seleccionado no es una foto.");
                $error = true;
                $alert = true;
            }
            if ($_FILES['foto']['size'] > 1000000) {
                MensajesFlash::anadir_mensaje("El archivo seleccionado es demasiado grande. Debe tener un tamaño inferior a 1MB");
                $error = true;
                $alert = true;
            }

            if (!$error) { // Si no hay errores formalizamos el registro


                $nombre_foto = md5(time() + rand(0, 999999));
                $extension_foto = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.') + 1);
                $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                
                //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                while (file_exists("img/users/$nombre_foto.$extension_foto")) {
                    $nombre_foto = md5(time() + rand(0, 999999));
                }

            
                //movemos la foto a la carpeta que queramos guardarla y con el nombre original
                move_uploaded_file($_FILES['foto']['tmp_name'], "img/users/$nombre_foto.$extension_foto");

                //Limpiamos los datos de entrada 
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS);
                $apellidos = filter_var($_POST['apellidos'], FILTER_SANITIZE_SPECIAL_CHARS);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
                $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_SPECIAL_CHARS);

                //Insertamos el usuario en la BBDD
                $usuario->setEmail($email);
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $usuario->setTelefono($telefono);
                $usuario->setFoto("$nombre_foto.$extension_foto");

                $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                $usuDAO->insert($usuario);
                MensajesFlash::anadir_mensaje("Usuario creado.");
                header("Location: " . RUTA);
                die();
            }
        }

        //Calculamos un token
        $token = md5(time() + rand(0, 999));
        $_SESSION['token'] = $token;

        require '../app/templates/registrar.php';
    }

    public function subir_foto()
    {
        if (($_FILES['foto']['type'] != 'image/png' &&
            $_FILES['foto']['type'] != 'image/gif' &&
            $_FILES['foto']['type'] != 'image/jpeg')) {
            MensajesFlash::anadir_mensaje('La imagen no tiene el formato adecuado');
            header("Location: " . RUTA);
            die();
        }

        $nombre_foto = md5(time() + rand(0, 999999));
        $extension_foto = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.') + 1);

        
        while (file_exists("img/users/$nombre_foto.$extension_foto")) {
            $nombre_foto = md5(time() + rand(0, 999999));
        }

       

        //movemos la foto a la carpeta que queramos guardarla y con el nombre original
        move_uploaded_file($_FILES['foto']['tmp_name'],"img/users/$nombre_foto.$extension_foto");
        //Actualizamos en la BD
        $conn = ConexionBD::conectar();
        $usuarioDAO = new UsuarioDAO($conn);
        $usuario = $usuarioDAO->find(Sesion::obtener()->getId());
        $usuario->setFoto("$nombre_foto.$extension_foto");
        $usuarioDAO->update($usuario);

        //Para que recarge en la sesión la nueva foto
        Sesion::iniciar($usuario);

        header("Location: " . RUTA);
    }

    public function login()
    {

        $usuDAO = new UsuarioDAO(ConexionBD::conectar());

        $alert = true;

        if (isset($_POST['email'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        } else {
            $alert = false;

            require '../app/templates/login.php';

            die();   
        }

        if (!$usuario = $usuDAO->findByEmail($email)) {
            //Usuario no encontrado

            MensajesFlash::anadir_mensaje("Usuario o password incorrectos.");

            require '../app/templates/login.php';

            die();
        }
        //Compruebo la contraseña, si no existe vuelvo a index con un parámetro de error
        if (!password_verify($_POST['password'], $usuario->getPassword())) {
            //password incorrecto
            MensajesFlash::anadir_mensaje("Usuario o password incorrectos.");

            require '../app/templates/login.php';

            die();
        }
        //Usuario y password correctos, redirijo al listado de anuncios
        Sesion::iniciar($usuario);

        //Generamos un código aleatorio sha1 y lo guardamos en la BD
        $usuario->setCookie_id(sha1(time() + rand()));
        $usuDAO->update($usuario);
        //Creamos la cookie en el navegador del cliente con el mismo código generado
        setcookie('uid', $usuario->getCookie_id(), time() + 60 * 60 * 24 * 7);

        header("Location: " . RUTA);
        die();
    }

    public function logout()
    {
        Sesion::cerrar();
        //Borramos la cookie diciendole al navegador que está caducada
        setcookie('uid', '', time() - 5);
        header("Location: " . RUTA);
    }

    public function existe_email()
    {

        sleep(1);

        $conn = ConexionBD::conectar();

        if ($conn->connect_error) {
            die("Error al conectar con MySQL: " . $conn->error);
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $result = $conn->query("SELECT * FROM USUARIOS WHERE EMAIL = '$email'");

        if ($result->num_rows > 0) {
            $respuesta = array("resultado" => true);
        } else {
            $respuesta = array("resultado" => false);
        }   

        header('Content-type: application/json');
        print json_encode($respuesta);
    }
}
