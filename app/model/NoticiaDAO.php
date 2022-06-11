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
        $sql = "INSERT INTO noticias (titulo, descripcion, fecha, foto) VALUES (:titulo, :descripcion, :fecha, :foto)";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':titulo', $noticia->getTitulo());
        $sentencia->bindParam(':descripcion', $noticia->getDescripcion());
        $sentencia->bindParam(':fecha', $noticia->getFecha());
        $sentencia->bindParam(':foto', $noticia->getFoto());
        $sentencia->execute();
    }

    public function update($noticia)
    {
        $sql = "UPDATE noticias SET titulo = :titulo, descripcion = :descripcion, fecha = :fecha, foto = :foto WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id', $noticia->getId());
        $sentencia->bindParam(':titulo', $noticia->getTitulo());
        $sentencia->bindParam(':descripcion', $noticia->getDescripcion());
        $sentencia->bindParam(':fecha', $noticia->getFecha());
        $sentencia->bindParam(':foto', $noticia->getFoto());
        $sentencia->execute();
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
