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

//......................

    // Método para crear o actualizar un ingrediente
    public function crear($id, $nombre, $foto, $precio, $tipo) {
        // Verificamos si el ingrediente con este ID ya existe
        $ingredienteExistente = $this->findById($id);

        if ($ingredienteExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $nombre, $foto, $precio, $tipo);
        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO ingredientes (id, nombre, foto, precio, tipo) VALUES (:id, :nombre, :foto, :precio, :tipo)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->execute();

            // Si se insertó el ingrediente, insertamos también sus alérgenos
            if ($stmt->rowCount() > 0) {
                $this->insertarAlergenos($id);
                return true;
            }
            return false;
        }
    }

    // Método para actualizar un ingrediente existente
    public function update($id, $nombre, $foto, $precio, $tipo, array $alergenos = []) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE ingredientes SET nombre = :nombre, foto = :foto, precio = :precio, tipo = :tipo WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

         // Actualizamos los alérgenos asociados
         $this->eliminarAlergenos($id);
         $this->insertarAlergenos($id, $alergenos);
 
         return $stmt->rowCount() > 0;
        }


        // Método auxiliar para insertar alérgenos
        private function insertarAlergenos($ingredienteId, array $alergenos) {
            $conexion = Conexion::getConection();
            foreach ($alergenos as $alergeno) {
                $stmt = $conexion->prepare("INSERT INTO ingredientes_has_alergenos (ingrediente_id, alergeno_id) VALUES (:ingrediente_id, :alergeno_id)");
                $stmt->bindParam(':ingrediente_id', $ingredienteId, PDO::PARAM_INT);
                $stmt->bindParam(':alergeno_id', $alergeno->getId(), PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    
        // Método auxiliar para eliminar todos los alérgenos asociados a un ingrediente
        private function eliminarAlergenos($ingredienteId) {
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("DELETE FROM ingredientes_alergenos WHERE ingrediente_id = :ingrediente_id");
            $stmt->bindParam(':ingrediente_id', $ingredienteId, PDO::PARAM_INT);
            $stmt->execute();
        }

}

?>