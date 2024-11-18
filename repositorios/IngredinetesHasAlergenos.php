<?php
class IngredientesHasAlergenos{
        // // Método para encontrar la relacion entre ingrediente y alergeno 
        public function findById($id) {
            $connection = Conexion::getConection();
            $stmt = $connection->prepare("SELECT * FROM ingredientes WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Ingredientes($row['id'], $row['nombre'], $row['foto'], $row['precio'],$row['tipo']);
            }
            return null; // Si no se encuentra el kebab
        }
    
        // Método para obtener todos los ingredientes
        public function findAll() {
            $connection = Conexion::getConection();
            $stmt = $connection->query("SELECT * FROM ingredientes");
    
            $ingredientes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ingredientes[] = new Ingredientes($row['id'], $row['nombre'], $row['foto'], $row['precio'], $row['tipo']);
            }
            return $ingredientes;
        }
}

?>