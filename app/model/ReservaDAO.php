<?php
/**
 * Description of ReservaDAO
 *
 * @author Gabriel Navalón Soriano
 */
class ReservaDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
     public function insert($reserva) {
          //Comprobamos que el parámetro sea de la clase Usuario
        if (!$reserva instanceof Reserva) {
            return false;
        }
        $id_usuario = $reserva->getId_usuario();
        $id_articulo = $reserva->getId_articulo();
        
        
        $sql = "INSERT INTO reservas (id_usuario, id_articulo) VALUES "
                . "($id_usuario, $id_articulo)";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }

        //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
        $reserva->setId($this->conn->insert_id);
        
        //Cambiamos en la base de datos de artículo el atributo RESERVADO
        $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
        $articulo = $articuloDAO->find($id_articulo);
        
        
        $reservado = 1;
        
        $sql2 = "UPDATE articulos SET"
                . " reservado=? "
                . "WHERE id = ?";
        if(!$stmt2 = $this->conn->prepare($sql2))
        {
            die("Error al preparar la consulta: ". $this->conn->error);
        }

        $stmt2->bind_param("ii", $reservado, $id_articulo);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        
        
        if ($stmt2->affected_rows == 1) {
            $articulo->setReservado(1);
            return true;
        } else {
            return false;
        }
    }
    
     public function findByIdUsuario($id_usuario) {
        $sql = "SELECT * FROM reservas WHERE id_usuario=$id_usuario";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_reservas = array();
        while ($reserva = $result->fetch_object('Reserva')) {
            $array_obj_reservas[] = $reserva;
        }
        return $array_obj_reservas;
    }
}
