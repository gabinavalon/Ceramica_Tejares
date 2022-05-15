<?php

/**
 * Acciones Foto
 * 
 * @author Gabriel Navalón Soriano
 */

class FotoDAO
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    /**
     * Método para insertar una nueva foto en la base de datos.
     * @param Foto $foto
     * @return boolean true si se crea la foto, false si no se recibe una instancia de foto
     */
    public function insert($foto)
    {
        //Comprobamos que el parámetro sea de la clase Foto
        if (!$foto instanceof Foto) {
            return false;
        }
        $nombre_archivo = $foto->getNombre_archivo();
        $id_articulo = $foto->getId_articulo();

        $sql = "insert into fotos (nombre_archivo, id_articulo) values (?,?)";

        //si la conssulta no se puede preparar da error
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }

        //Ejecución de la consulta
        $stmt->bind_param('si', $nombre_archivo, $id_articulo);
        $stmt->execute();

        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $foto->setId($this->conn->insert_id);
        return true;
    }

    /**
     * Borra un registro de la tabla Fotos
     * @param type $foto Objeto de la clase foto
     * @return boolean Devuelve true si se ha borrado una foto y false en caso contrario
     */
    public function delete($foto)
    {
        //Comprobamos que el parámetro no es nulo y es de la clase Usuario
        if ($foto == null || get_class($foto) != 'Foto') {
            return false;
        }
        $sql = "DELETE FROM fotos WHERE id = ?";
        //si la conssulta no se puede preparar da error
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        //Ejecución de la consulta
        $stmt->bind_param('i', $foto->getId());
        $stmt->execute();
        
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Devuelve foto de la BD 
     * @param  $id id de la foto
     * @return \ Foto de la BD o null si no existe
     */
    public function find($id)
    { //: Usuario especifica el tipo de datos que va a devolver pero no es obligatorio ponerlo
        $sql = "SELECT * FROM fotos WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        return $result->fetch_object('Foto');
    }

    /**
     * Devuelve las fotos relacionadas a un artículo en específico
     * @param type $id_artiuclo
     * @return array Array de objetos de la clase Foto
     */
    public function findbyIdArticulo($id_articulo)
    {
        $sql = "SELECT * FROM fotos WHERE id_articulo=$id_articulo";

        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_fotos = array();
        while ($foto = $result->fetch_object('Foto')) {
            $array_obj_fotos[] = $foto;
        }
        return $array_obj_fotos;
    }
}
