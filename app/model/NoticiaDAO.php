<?php

/**
 * Description of NoticiaDAO
 * 
 * @author Gabriel Navalón Soriano
 */
 

 // TODA ESTA CLASE LA HA HECHO EL COPILOT, A VER SI FUNCIONA?¿?

 class NoticiaDAO{

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function findAll() {
        $sql = "SELECT * FROM noticia";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $noticias = [];
        foreach ($resultado as $fila) {
            $noticia = new Noticia();
            $noticia->setId($fila['id']);
            $noticia->setTitulo($fila['titulo']);
            $noticia->setDescripcion($fila['descripcion']);
            $noticia->setFecha($fila['fecha']);
            $noticia->setFoto($fila['foto']);
            $noticias[] = $noticia;
        }
        return $noticias;
    }

    public function find($id) {
        $sql = "SELECT * FROM noticia WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
        $noticia = new Noticia();
        $noticia->setId($resultado['id']);
        $noticia->setTitulo($resultado['titulo']);
        $noticia->setDescripcion($resultado['descripcion']);
        $noticia->setFecha($resultado['fecha']);
        $noticia->setFoto($resultado['foto']);
        return $noticia;
    }

    public function insert($noticia) {
        $sql = "INSERT INTO noticia (titulo, descripcion, fecha, foto) VALUES (:titulo, :descripcion, :fecha, :foto)";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':titulo', $noticia->getTitulo());
        $sentencia->bindParam(':descripcion', $noticia->getDescripcion());
        $sentencia->bindParam(':fecha', $noticia->getFecha());
        $sentencia->bindParam(':foto', $noticia->getFoto());
        $sentencia->execute();
    }

    public function update($noticia) {
        $sql = "UPDATE noticia SET titulo = :titulo, descripcion = :descripcion, fecha = :fecha, foto = :foto WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id', $noticia->getId());
        $sentencia->bindParam(':titulo', $noticia->getTitulo());
        $sentencia->bindParam(':descripcion', $noticia->getDescripcion());
        $sentencia->bindParam(':fecha', $noticia->getFecha());
        $sentencia->bindParam(':foto', $noticia->getFoto());
        $sentencia->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM noticia WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
    }

 }