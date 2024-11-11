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
    //----------------------------------------------------------------
     // Método para crear o actualizar un ingrediente
     public function crear($id, $nombre, $foto, $precio, $descripcion) {
        // Verificamos si el ingrediente con este ID ya existe
        $kebabExistente = $this->findById($id);

        if ($kebabExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $nombre, $foto, $precio, $descripcion, $ingredientes = []);
        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO kebab (id, nombre, foto, precio, c) VALUES (:id, :nombre, :foto, :precio, :descripcion)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->execute();

            // Si se insertó el kebab, insertamos también sus ingredientes
            if ($stmt->rowCount() > 0) {
                $this->insertarIngredientes($id,$IngredientesId);
                return true;
            }
            return false;
        }
    }

    // Método para actualizar un kebab existente
    public function update($id, $nombre, $foto, $precio, $tipo, $ingredientes) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE kebab SET nombre = :nombre, foto = :foto, precio = :precio, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Actualizamos los ingredientes asociados
        //elimino todos lo ingredientes
        $this->eliminarAlergenosAll($id);

        //Inserto los ingredientes nuevos 
        if (is_array($ingredientes)) {
            foreach ($ingredientes as $ingredientesId) {
                $this->insertarAlergenos($id, $ingredientesId);
            }
        }
         return $stmt->rowCount() > 0;
        }


        // Método auxiliar para insertar ingredientes en el caso de que exista el kebab
        private function insertarIngredientes($kebabId,$IngredienteId) {
            $conexion = Conexion::getConection();
            if ($kebabId == $id) {
                $stmt = $conexion->prepare("INSERT INTO kebab_has_ingredientes (kebab_id, Ingredientes_id) VALUES (:kebab_id, :kebab_id)");
                $stmt->bindParam(':kebab_id', $kebabId, PDO::PARAM_INT);
                $stmt->bindParam(':Ingredientes_id', $IngredienteId, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    
        // Método auxiliar para eliminar todos los ingredientes asociados a un kebab
        private function eliminarIngredientesAll($kebabId) {
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("DELETE FROM kebab_has_ingredientes WHERE kebab_id = :kebab_id");
            $stmt->bindParam(':kebab_id', $kebabId, PDO::PARAM_INT);
            $stmt->execute();
        }





}

?>