<?php

require_once ROOT_PATH . 'clases/Ingredientes.php';
require_once ROOT_PATH . 'repositorios/Conexion.php';
class RepoIngredientes {

    // // Método para encontrar un ingrediente por su ID
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

    // Método para eliminar un ingredientes por su ID
    public function delete($id) {
    $connection = Conexion::getConection();
    $stmt = $connection->prepare("DELETE FROM ingredientes WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->rowCount() > 0; // Retorna true si se eliminó algún registro
    }

    // Método para crear o actualizar un ingrediente
    public function crear($id, $nombre, $foto, $precio, $tipo, $alergenos = []) {
        // Verificamos si el ingrediente con este ID ya existe
        $ingredienteExistente = $this->findById($id);

        if ($ingredienteExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $nombre, $foto, $precio, $tipo, $alergenos);

        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO ingredientes (id, nombre, foto, precio, tipo) VALUES (:id, :nombre, :foto, :precio, :tipo)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->execute();

            // Si se insertó el ingrediente, insertamos también sus alérgenos
            //si el array de alergenos esta vacío no lo recorremos 
            if ($stmt->rowCount() > 0) {
                if(!empty($alergenos)){
                    foreach ($alergenos as $alergenoId) {
                        $this->insertarAlergenos($id, $alergenoId);
                    }
                    // return true;
                }
            }
            // return false;
            // Obtenemos el ingrediente actualizado
            $ingrediente = $this->findById($id); 

            // Llenar el array de alérgenos para el ingrediente
            $ingrediente->llenarAlergenos();
            
        }
    }

    // Método para actualizar un ingrediente existente
    public function update($id, $nombre, $foto, $precio, $tipo, $alergenos=[]) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE ingredientes SET nombre = :nombre, foto = :foto, precio = :precio, tipo = :tipo WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Actualizamos los alérgenos asociados
        //elimino todos lo alergenos
        $this->eliminarAlergenosAll($id);
        // var_dump($alergenos);
        //Inserto los alergenos nuevos 
        
        foreach ($alergenos as $alergenoId) {
            $this->insertarAlergenos($id, $alergenoId);//AQUI HICE UNA MODIFICACIÓN
        }

        // Obtenemos el ingrediente actualizado
        $ingrediente = $this->findById($id);  
        // var_dump($ingrediente);

        // Llenar el array de alérgenos para el ingrediente
        $ingrediente->llenarAlergenos();
        // var_dump($ingrediente);

        
        return $stmt->rowCount() > 0;
    }



    // Método auxiliar para insertar alérgenos en el caso de que exista el ingrediente
    private function insertarAlergenos($ingredienteId,$AlergenoId) {
        $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO ingredientes_has_alergenos (ingredientes_id, alergenos_id) VALUES (:ingredientes_id, :alergenos_id)");
            $stmt->bindParam(':ingredientes_id', $ingredienteId, PDO::PARAM_INT);
            $stmt->bindParam(':alergenos_id', $AlergenoId, PDO::PARAM_INT);
            $stmt->execute();
            
    }

    // Método auxiliar para eliminar todos los alérgenos asociados a un ingrediente
    private function eliminarAlergenosAll($ingredienteId) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("DELETE FROM ingredientes_has_alergenos WHERE ingredientes_id = :ingredientes_id");
        $stmt->bindParam(':ingredientes_id', $ingredienteId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Método para obtener alérgenos asociados a un ingrediente
    public function obtenerAlergenosPorIngrediente($ingredienteId) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("SELECT alergenos_id FROM ingredientes_has_alergenos WHERE ingredientes_id = :ingredientes_id");
        $stmt->bindParam(':ingredientes_id', $ingredienteId, PDO::PARAM_INT);
        $stmt->execute();
        //devuelvo un array con los alergenos
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        
    }
}

?>