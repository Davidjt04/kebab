<?php

require_once ROOT_PATH . 'clases/Kebab.php';
require_once ROOT_PATH . 'repositorios/Conexion.php';
class RepoKebab {

    // Método para encontrar un Kebab por su ID
    public function findById($id) {
        $connection = Conexion::getConection();
        $stmt = $connection->prepare("SELECT * FROM kebab WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Kebab($row['id'], $row['nombre'], $row['foto'], $row['precio']);
        }
        return null; // Si no se encuentra el kebab
    }

    // Método para obtener todos los Kebabs
    public function findAll() {
        $connection = Conexion::getConection();
        $stmt = $connection->query("SELECT * FROM kebab");

        $kebabs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $kebabs[] = new Kebab($row['id'], $row['nombre'], $row['foto'], $row['precio']);
        }
        return $kebabs;
    }

    // Método para eliminar un Kebab por su ID
    public function delete($id) {
    $connection = Conexion::getConection();
    $stmt = $connection->prepare("DELETE FROM kebab WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->rowCount() > 0; // Retorna true si se eliminó algún registro
    }
}

?>