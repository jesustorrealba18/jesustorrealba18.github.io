<?php
require_once 'datos.php'; // Incluye la clase de conexión

class Categoria {
    private $db;

    public function __construct() {
        $this->db = (new datos())->conecta(); // Establece la conexión
    }

    public function obtenerCategorias() {
        $query = "SELECT * FROM categoria";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo
    }
}

?>