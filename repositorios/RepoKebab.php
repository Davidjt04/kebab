<?php
class RepoKebab {

    // Método para encontrar un Kebab por su ID
    public function findById($id) {
        $connection = Conexion::getConection();
        $stmt = $connection->prepare("SELECT * FROM kebab WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Kebab($row['id'], $row['nombre'], $row['foto'], $row['precio'],$row['descripcion']);
        }
        return null; // Si no se encuentra el kebab
    }

    // Método para obtener todos los Kebabs
    public function findAll() {
        $connection = Conexion::getConection();
        $stmt = $connection->query("SELECT * FROM kebab");

        $kebabs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $kebabs[] = new Kebab($row['id'], $row['nombre'], $row['foto'], $row['precio'], $row['descripcion']);
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
     public function crear($id, $nombre, $foto, $precio, $descripcion, $ingredientes = []) {
        // Verificamos si el ingrediente con este ID ya existe
        $kebabExistente = $this->findById($id);

        if ($kebabExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $nombre, $foto, $precio, $descripcion, $ingredientes);
        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO kebab (id, nombre, foto, precio, descripcion) VALUES (:id, :nombre, :foto, :precio, :descripcion)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio);       //no tiene la especificación de que tipo de PDO es ya que no hay tipo DOUBLE que es el que necesito
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->execute();

            // Si se insertó el kebab, insertamos también sus ingredientes
            if ($stmt->rowCount() > 0) {
                if(!empty($ingredientes)){
                    foreach ($ingredientes as $IngredienteId) {
                        $this->insertarIngredientes($id, $IngredienteId);
                    }
                    // return true;
                }
            // return false;
            }
            // return false;
            // Obtenemos el kebab actualizado
            $kebab = $this->findById($id); 
            // var_dump($kebab);

            // Llenar el array de ingredientes para el kebab
            $kebab->llenarIngredientes();
            // var_dump($kebab);
        }
    }

    // Método para actualizar un kebab existente
    public function update($id, $nombre, $foto, $precio, $tipo, $ingredientes= []) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE kebab SET nombre = :nombre, foto = :foto, precio = :precio, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':descripcion', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Actualizamos los ingredientes asociados
        //elimino todos lo ingredientes
        $this->eliminarIngredientesAll($id);

        //Inserto los ingredientes nuevos 
        if (is_array($ingredientes)) {
            foreach ($ingredientes as $ingredientesId) {
                $this->insertarIngredientes($id, $ingredientesId);
            }
        }

        // Obtenemos el kebab actualizado
        $kebab = $this->findById($id); 
        // Llenar el array de ingredientes para el kebab
        $kebab->llenarIngredientes();
        // var_dump($kebab);


        return $stmt->rowCount() > 0;
        }


        // Método auxiliar para insertar ingredientes en el caso de que exista el kebab
        private function insertarIngredientes($kebabId,$IngredienteId) {
            $conexion = Conexion::getConection();
                $stmt = $conexion->prepare("INSERT INTO kebab_has_ingredientes (kebab_id, ingredientes_id) VALUES (:kebab_id, :ingredientes_id)");
                $stmt->bindParam(':kebab_id', $kebabId, PDO::PARAM_INT);
                $stmt->bindParam(':ingredientes_id', $IngredienteId, PDO::PARAM_INT);
                $stmt->execute();
        }
    
        // Método auxiliar para eliminar todos los ingredientes asociados a un kebab
        private function eliminarIngredientesAll($kebabId) {
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("DELETE FROM kebab_has_ingredientes WHERE kebab_id = :kebab_id");
            $stmt->bindParam(':kebab_id', $kebabId, PDO::PARAM_INT);
            $stmt->execute();
        }


        // Método para obtener ingredientes asociados a un kebab
        public function obtenerIngredientesPorKebab($kebabId) {
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("SELECT ingredientes_id FROM kebab_has_ingredientes WHERE kebab_id = :kebab_id");
            $stmt->bindParam(':kebab_id', $kebabId, PDO::PARAM_INT);
            $stmt->execute();
            //devuelvo un array con los ingredientes
            return $stmt->fetchAll(PDO::FETCH_COLUMN);  
            
        }




}

?>