<?php

class ContactoDAO{
        
        private $conn;
        
        public function __construct($conn) {
            $this->conn = $conn;
        }

        /**
         * Método para insertar un nuevo contacto en la base de datos.
         * @param Contacto $contacto
         * @return boolean true si se crea el contacto, false si no se recibe una instancia de contacto
         */
        public function insert($contacto) {
            //Comprobamos que el parámetro sea de la clase Usuario
            if (!$contacto instanceof Contacto) {
                return false;
            }
            $nombre = $contacto->getNombre();
            $email = $contacto->getEmail();
            $asunto = $contacto->getAsunto();
            $texto = $contacto->getTexto();

            $sql = "INSERT INTO contactos (nombre, email, asunto, texto) VALUES (?,?,?,?)";
            
            $stmt = $this->conn->prepare($sql); // preparamos la consulta
           
            if (!$stmt) { // si no se puede preparar, error
                die("Error en la SQL: " . $this->conn->error);
            }
            // ahora ejecutamos la consulta
            $stmt->bind_param('ssss', $nombre, $email, $texto, $asunto);
            $stmt->execute();
            $result = $stmt->get_result();
         
            //Guardo el id que le ha asignado la base de datos en la propiedad id del objeto
            $contacto->setId($this->conn->insert_id);
            return true;
        }

        public function findAll($orden = 'ASC', $campo = 'fecha')
        {
            $sql = "SELECT * FROM contactos ORDER BY $campo $orden";
            if (!$result = $this->conn->query($sql)) {
                die("Error en la SQL: " . $this->conn->error);
            }
            $contactos = array();
            while ($contacto = $result->fetch_object('Contacto')) {
                $contactos[] = $contacto;
            }
            return $contactos;
        }

        public function find($id)
        {
            $sql = "SELECT * FROM contactos WHERE id=$id";
            if (!$result = $this->conn->query($sql)) {
                die("Error en la SQL: " . $this->conn->error);
            }
            return $result->fetch_object('Contacto');
        }
    
        public function update($contacto)
        {
            //Comprobamos que el parámetro es de la clase Noticia
            if (!$contacto instanceof Contacto) {
                return false;
            }
            
            $nombre = $contacto->getNombre();
            $email = $contacto->getEmail();
            $asunto = $contacto->getAsunto();
            $texto = $contacto->getTexto();
            $id = $contacto->getId();
            $leido = $contacto->getLeído();

            $sql = "UPDATE contactos SET nombre=?, email=?, asunto=?, texto=?, leído=? WHERE id=?";

            if (!$stmt = $this->conn->prepare($sql)) {
                die("Error en la SQL: " . $this->conn->error);
            }

            $stmt->bind_param('ssssii', $nombre, $email, $asunto, $texto, $leido, $id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if ($this->conn->affected_rows == 1) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($contacto) {
            //Comprobamos que el parámetro no es nulo y es de la clase Contacto
            if ($contacto == null || get_class($contacto) != 'Contacto') {
                return false;
            }
            $sql = "DELETE FROM contactos WHERE id = " . $contacto->getId();
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