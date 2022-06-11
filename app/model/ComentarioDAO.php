<?php


class ComentarioDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert($comentario) {
        //Comprobamos que el parámetro sea de la clase Usuario
        if (!$comentario instanceof Comentario) {
            return false;
        }

        $texto = $comentario->getTexto();
        $id_noticia = $comentario->getId_noticia();
        $id_usuario = $comentario->getId_usuario();

        $sql = "INSERT INTO comentarios (texto, id_noticia, id_usuario) VALUES "
                . "(?,?,?)";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error al preparar la consulta: " . $this->conn->error);
        }

        $stmt->bind_param('sii', $texto, $id_noticia, $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $comentario->setId($this->conn->insert_id);
        return true;
    }

    public function delete($comentario) {

        if (!$comentario instanceof Comentario) {
            return false;
        }
        $sql = "DELETE FROM comentarios WHERE id = " . $comentario->getId();
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function findbyNoticia($id_noticia) {

        $sql = "SELECT *,date_format(fecha,'%e/%c/%Y') as fecha FROM comentarios WHERE id_noticia=? ORDER BY id DESC";
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la consulta $sql:" . $this->conn->error);
        }


        $stmt->bind_param('i', $id_noticia);
        $stmt->execute();
        $result = $stmt->get_result();

        $array_obj_comentarios = array();
        while ($comentario = $result->fetch_object('Comentario')) {
            $array_obj_comentarios[] = $comentario;
        }
        return $array_obj_comentarios;
    }
    
    public function find($id){
        $sql = "SELECT * FROM comentarios WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        return $result->fetch_object('Comentario');
    }

}
