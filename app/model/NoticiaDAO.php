<?php

/**
 * Description of NoticiaDAO
 * 
 * @author Gabriel Navalón Soriano
 */


// TODA ESTA CLASE LA HA HECHO EL COPILOT, A VER SI FUNCIONA?¿?

class NoticiaDAO
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function findAll($orden = 'ASC', $campo = 'id')
    {
        $sql = "SELECT * FROM noticias ORDER BY $campo $orden";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_noticias = array();
        while ($noticia = $result->fetch_object('Noticia')) {
            $array_obj_noticias[] = $noticia;
        }
        return $array_obj_noticias;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM noticias WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        return $result->fetch_object('Noticia');
    }

    public function insert($noticia)
    {
        //Comprobamos que el parámetro sea de la clase Noticia
        if (!$noticia instanceof Noticia) {
            return false;
        }
        $titulo = $noticia->getTitulo();
        $descripcion = $noticia->getDescripcion(); 
        $foto = "foto_generica.png";


        $sql = "INSERT INTO noticias (titulo, descripcion, foto) VALUES (?,?,?)";
        
        $stmt = $this->conn->prepare($sql); // preparamos la consulta
       
        if (!$stmt) { // si no se puede preparar, error
            die("Error en la SQL: " . $this->conn->error);
        }
        // ahora ejecutamos la consulta
        $stmt->bind_param('sss', $titulo, $descripcion, $foto);
        $stmt->execute();
        $result = $stmt->get_result();
     
        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $noticia->setId($this->conn->insert_id);
        return true;
    }

    public function update($noticia)
    {
        //Comprobamos que el parámetro es de la clase Noticia
        if (!$noticia instanceof Noticia) {
            return false;
        }
        $titulo = $noticia->getTitulo();
        $descripcion = $noticia->getDescripcion();
        $id = $noticia->getId();
        $foto = $noticia->getFoto();
        $sql = "UPDATE noticias SET"
                . " titulo=?, descripcion=?,foto=? WHERE id = ? " ;
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        
        $stmt->bind_param("sssi", $titulo, $descripcion, $foto, $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($noticia) {
        //Comprobamos que el parámetro no es nulo y es de la clase Noticia
        if ($noticia == null || get_class($noticia) != 'Noticia') {
            return false;
        }
        $sql = "DELETE FROM noticias WHERE id = " . $noticia->getId();
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
}
