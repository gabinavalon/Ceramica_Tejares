<?php

/**
 * Controlador de noticias
 * 
 * @author Gabriel Navalón
 */


class ControladorNoticia
{

    public function insertar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Comprobamos el token
            if ($_POST['token'] != $_SESSION['token']) {
                header('Location: index.php');
                MensajesFlash::anadir_mensaje("Token incorrecto");
                die();
            }

            $noticia = new Noticia();
            $error = false;
            if (empty($_POST['titulo'])) {
                MensajesFlash::anadir_mensaje("El titulo es obligatorio.");
                $error = true;
            }
            if (empty($_POST['descripcion'])) {
                MensajesFlash::anadir_mensaje("La descripción es obligatorio.");
                $error = true;
            }

            if (!$error) { // Si no hay errores subimos la noticia

                $nombre_foto = md5(time() + rand(0, 999999));
                $extension_foto = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.') + 1);
                $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                while (file_exists("img/$nombre_foto.$extension_foto")) {
                    $nombre_foto = md5(time() + rand(0, 999999));
                }
                //movemos la foto a la carpeta que queramos guardarla y con el nombre original
                move_uploaded_file($_FILES['foto']['tmp_name'], "img/$nombre_foto.$extension_foto");

                //Limpiamos los datos de entrada

                $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);
                $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_SPECIAL_CHARS);

                $noticia->setTitulo($titulo);
                $noticia->setDescripcion($descripcion);
                $noticia->setFoto("$nombre_foto.$extension_foto");

                $noticiaDAO = new NoticiaDAO(ConexionBD::conectar());
                $noticiaDAO->insert($noticia);
                MensajesFlash::anadir_mensaje("Noticia insertada.");
                header('Location: inicio');
                die();
            }
        }
    }

    public function modificar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Comprobamos el token
            if ($_POST['token'] != $_SESSION['token']) {
                header('Location: index.php');
                MensajesFlash::anadir_mensaje("Token incorrecto");
                die();
            }

            $error = false;
            if (empty($_POST['titulo'])) {
                MensajesFlash::anadir_mensaje("El titulo es obligatorio.");
                $error = true;
            }
            if (empty($_POST['descripcion'])) {
                MensajesFlash::anadir_mensaje("La descripción es obligatorio.");
                $error = true;
            }

            if (!$error) { // Si no hay errores actualizamos la noticia

                //Comprobar que pasa si no cambias la foto ¿?

                $nombre_foto = md5(time() + rand(0, 999999));
                $extension_foto = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.') + 1);
                $extension_foto = filter_var($extension_foto, FILTER_SANITIZE_SPECIAL_CHARS);
                //Comprobamos que no exista ya una foto con el mismo nombre, si existe calculamos uno nuevo
                while (file_exists("img/$nombre_foto.$extension_foto")) {
                    $nombre_foto = md5(time() + rand(0, 999999));
                }
                //movemos la foto a la carpeta que queramos guardarla y con el nombre original
                move_uploaded_file($_FILES['foto']['tmp_name'], "img/$nombre_foto.$extension_foto");

                //Limpiamos los datos de entrada

                $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);
                $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_SPECIAL_CHARS);

                $NoticiaDAO = new NoticiaDAO(ConexionBD::conectar());
                $noticia = $NoticiaDAO->find($_POST['id']);
                $noticia->setTitulo($titulo);
                $noticia->setDescripcion($descripcion);
                $noticia->setFoto("$nombre_foto.$extension_foto");

                $NoticiaDAO->update($noticia);
                MensajesFlash::anadir_mensaje("Noticia actualizada.");
                header('Location: inicio');
                die();
            }
        } else {

            $conn = ConexionBD::conectar();
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            $noticiaDAO = new NoticiaDAO($conn);
            $noticia = $noticiaDAO->find($id);

            require '../app/vistas/modificar_noticia.php';
        }
    }

    public function borrar()
    {

        //Comprobamos que el token recibido es igual al que tenemos en la variable de sesión para evitar ataques CSRF
        if ($_GET['t'] != $_SESSION['token']) {
            header("Location: " . RUTA);
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

        header("Location: " . RUTA);
    }
}
