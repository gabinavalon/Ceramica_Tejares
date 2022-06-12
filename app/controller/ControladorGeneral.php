<?php

class ControladorGeneral{

    public function listar(){


        $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
        $articulos = $articuloDAO->findAll('DESC', 'fecha');
        $noticiaDAO = new NoticiaDAO(ConexionBD::conectar());
        $noticias = $noticiaDAO->findAll('DESC', 'fecha');

        //Mostramos las tres noticias más recientes
        $n1 = $noticias[0];
        $n2 = $noticias[1];
        $n3 = $noticias[2];

        //Mostramos los seis últimos artículos
        $ultimosArticulos = array();
        for ($i = 0; $i < 6; $i++) {
            $ultimosArticulos[] = $articulos[$i];
        } 

        $likeDAO = new LikeDAO(ConexionBD::conectar());
        $likes = $likeDAO->findAll();

        require '../app/templates/inicio.php';
    }

    public function tecnicas(){

        require '../app/templates/tecnicasyactividades.php';
    }

    public function contacto(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = filter_var($_POST['nombre'],  FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $texto = filter_var($_POST['texto'],  FILTER_SANITIZE_SPECIAL_CHARS);
            $asunto = filter_var($_POST['asunto'],  FILTER_SANITIZE_SPECIAL_CHARS);

            $conn = ConexionBD::conectar();
            $contactoDAO = new ContactoDAO($conn);
            $contacto = new Contacto();
            
            $contacto->setNombre($nombre);
            $contacto->setEmail($email);
            $contacto->setTexto($texto);
            $contacto->setAsunto($asunto);

            if($contactoDAO->insert($contacto)){
                MensajesFlash::anadir_mensaje('Se ha enviado tu mensaje correctamente');
                header("Location: " . RUTA);
                die();
            }else{
                MensajesFlash::anadir_mensaje('Ha habido un error al contactar, inténtelo otra vez o pruebe otro método');
                header("Location: " . RUTA);
                die();
            };

        }

        require '../app/templates/inicio.php';
    }
    }
