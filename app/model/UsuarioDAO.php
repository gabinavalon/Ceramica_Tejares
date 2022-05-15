<?php

/**
 * Acciones Usuario
 *
 * @author Gabriel Navalón Soriano
 */
class UsuarioDAO {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Método para insertar un nuevo usuario en la base de datos.
     * @param Usuario $usuario
     * @return boolean true si se crea el usuario, false si no se recibe una instancia de usuario
     */
    public function insert($usuario) {

        //Comprobamos que el parámetro sea de la clase Usuario
        if (!$usuario instanceof Usuario) {
            return false;
        }

        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $telefono = $usuario->getTelefono();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $foto = $usuario->getFoto();
        $cookie_id = sha1(time() + rand());

        $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, email, password, foto, cookie_id) VALUES "
                . "(?,?,?,?,?,?,?)";

        //si la conssulta no se puede preparar da error
        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        //Ejecución de la consulta
        $stmt->bind_param('sssssss', $nombre, $apellidos, $telefono, $email, $password, $foto, $cookie_id);
        $stmt->execute();
        // $result = $stmt->get_result();
        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $usuario->setId($this->conn->insert_id);
        return true;
    }

    /**
     * 
     * @param Usuario $usuario
     * @return boolean true si se modifica el usuario correctamente
     */
    public function update($usuario) {
        //Comprobamos que el parámetro es de la clase Usuario
        if (!$usuario instanceof Usuario) {
            return false;
        }
        $id = $usuario->getId();
        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $telefono = $usuario->getTelefono();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $foto = $usuario->getFoto();
        $cookie_id = $usuario->getCookie_id();
        $sql = "UPDATE usuarios SET"
                . " nombre=?, apellidos=?, telefono=?, email=?, password=?, foto=?, cookie_id=? "
                . "WHERE id = ?";

        if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }

        $stmt->bind_param("sssssssi", $nombre, $apellidos, $telefono, $email, $password, $foto, $cookie_id, $id);
        $stmt->execute();

    //    $result = $stmt->get_result();

        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Borra un registro de la tabla Usuarios
     * @param type $usuario Objeto de la clase usuario
     * @return bool Devuelve true si se ha borrado un usuario y false en caso contrario
     */
    public function delete($usuario) {
      //Comprobamos que el parámetro no es nulo y es de la clase Usuario
        if ($usuario == null || get_class($usuario) != 'Usuario') {
            return false;
        }
        $sql = "DELETE FROM usuarios WHERE id = ?";
        
         if (!$stmt = $this->conn->prepare($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        
        $stmt->bind_param("i",  $usuario->getId());
        $stmt->execute();
        
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Devuelve el usuario de la BD 
     * @param type $id id del usuario
     * @return \Usuario Usuario de la BD o null si no existe
     */
    public function find($id) { //: Usuario especifica el tipo de datos que va a devolver pero no es obligatorio ponerlo
        $sql = "SELECT * FROM usuarios WHERE id=$id";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL : " . $this->conn->error);
        }
        return $result->fetch_object('Usuario');

    }

    /**
     * Devuelve todos los usuarios de la BD
     * @param type $orden Tipo de orden (ASC o DESC)
     * @param type $campo Campo de la BD por el que se van a ordenar
     * @return array Array de objetos de la clase Usuario
     */
    public function findAll($orden = 'ASC', $campo = 'id') {
        $sql = "SELECT * FROM usuarios ORDER BY $campo $orden";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_usuarios = array();
        while ($usuario = $result->fetch_object('Usuario')) {
            $array_obj_usuarios[] = $usuario;
        }
        return $array_obj_usuarios;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        return $result->fetch_object('Usuario');
    }

    public function findByCookie_id($cookie_id) {
        $sql = "SELECT * FROM usuarios WHERE cookie_id='$cookie_id'";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL : " . $this->conn->error);
        }
        return $result->fetch_object('Usuario');
    }

}
