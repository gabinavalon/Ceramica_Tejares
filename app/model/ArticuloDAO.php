<?php

/**
 * Description of ArticuloDAO
 *
 * @author Gabriel Navalón Soriano
 */
class ArticuloDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    

    /**
     * Método para insertar un nuevo artículo en la base de datos.
     * @param Articulo $articulo
     * @return boolean true si se crea el artículo, false si no se recibe una instancia de artículo
     */
     
    public function insert($articulo) {
        //Comprobamos que el parámetro sea de la clase Usuario
        if (!$articulo instanceof Articulo) {
            return false;
        }
        $titulo = $articulo->getTitulo();
        $descripcion = $articulo->getDescripcion();
        $precio = $articulo->getPrecio();
        $reservado = $articulo->getReservado();
        $sql = "INSERT INTO articulos (titulo, descripcion, precio, reservado) VALUES (?,?,?,?)";
        
        $stmt = $this->conn->prepare($sql); // preparamos la consulta
       
        if (!$stmt) { // si no se puede preparar, error
            die("Error en la SQL: " . $this->conn->error);
        }
        // ahora ejecutamos la consulta
        $stmt->bind_param('ssdi', $titulo, $descripcion, $precio, $reservado);
        $stmt->execute();
        $result = $stmt->get_result();
     
        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $articulo->setId($this->conn->insert_id);
        return true;
    }

    /**
     * Actualizaremos el artículo en la base de datos.
     * @param Articulo $articulo
     * @return boolean true si se modifica el artículo correctamente
     */
    public function update($articulo) {
        //Comprobamos que el parámetro es de la clase Usuario
        if (!$articulo instanceof Articulo) {
            return false;
        }
        $titulo = $articulo->getTitulo();
        $descripcion = $articulo->getDescripcion();
        $precio = $articulo->getPrecio();
        $reservado = $articulo->getReservado();
        $id = $articulo->getId();
        $sql = "UPDATE articulos SET"
                . " titulo=?, descripcion=?,precio=?,reservado=? WHERE id = ? " ;
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        
        $stmt->bind_param("ssdii", $titulo, $descripcion, $precio, $reservado, $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Borra un registro de la tabla Artículos
     * @param type $articulo Objeto de la clase artículo
     * @return bool Devuelve true si se ha borrado el artículo y false en caso contrario
     */
    public function delete($articulo) {
        //Comprobamos que el parámetro no es nulo y es de la clase Usuario
        if ($articulo == null || get_class($articulo) != 'Articulo') {
            return false;
        }
        $sql = "DELETE FROM articulos WHERE id = " . $articulo->getId();
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Devuelve el articulo de la BD 
     * @param  $id id del artículo
     * @return \ Articulo de la BD o null si no existe
     */
    public function find($id) { //: Usuario especifica el tipo de datos que va a devolver pero no es obligatorio ponerlo
        $sql = "SELECT * FROM articulos WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        return $result->fetch_object('Articulo');
    }
    

    /**
     * Devuelve todos los articulos de la BD
     * @param type $orden Tipo de orden (ASC o DESC)
     * @param type $campo Campo de la BD por el que se van a ordenar
     * @return array Array de objetos de la clase Artículo
     */
    public function findAll($orden = 'ASC', $campo = 'id') {
        $sql = "SELECT * FROM articulos ORDER BY $campo $orden";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_articulos = array();
        while ($articulo = $result->fetch_object('Articulo')) {
            $array_obj_articulos[] = $articulo;
        }
        return $array_obj_articulos;
    }

}
