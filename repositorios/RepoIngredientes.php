<?php

require_once ROOT_PATH . 'clases/Ingredientes.php';
require_once ROOT_PATH . 'repositorios/Conexion.php';
class RepoIngredientes {

    // Método para encontrar un ingrediente por su ID
    public function findById($id) {
        $connection = Conexion::getConection();
        $stmt = $connection->prepare("SELECT * FROM ingredientes WHERE id = ?");
        $stmt->bindParam("1", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Ingredientes($row['id'], $row['nombre'], $row['foto'], $row['precio']);
        }
        return null; // Si no se encuentra el kebab
    }

    // Método para obtener todos los ingredientes
    public function findAll() {
        $connection = Conexion::getConection();
        $stmt = $connection->query("SELECT * FROM ingredientes");

        $ingredientes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ingredientes[] = new Ingredientes($row['id'], $row['nombre'], $row['foto'], $row['precio']);
        }
        return $ingredientes;
    }

    // Método para eliminar un ingredientes por su ID
    public function delete($id) {
    $connection = Conexion::getConection();
    $stmt = $connection->prepare("DELETE FROM ingredientes WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->rowCount() > 0; // Retorna true si se eliminó algún registro
    }
}

?>