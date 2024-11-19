<?php
include '../repositorios/Conexion.php';
include '../clases/Ingredientes.php';
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

    // Método para eliminar un ingredientes por su ID
    public function deleteIngredientes_has_alergenos($id) {
        $connection = Conexion::getConection();
        $stmt = $connection->prepare("DELETE FROM ingredientes_has_alergenos WHERE ingredientes_id = :id");
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

    
    /*metodo que haga un join con la tabla de ingredientes y la de alergenos 
    cuando tenga el select mirar en la tabla muchos muchos el los alergenos que esten con 
    el id de ingrediente 1 se meten en su array */
    public function ingredienteCompletoPorId($id) {
        $connection = Conexion::getConection();
        $stmt = $connection->prepare("SELECT distinct i.id as Ingrediente_id, i.nombre, i.foto, i.precio, i.tipo, a.id as Alergeno_id
                                    FROM ingredientes i
                                    LEFT JOIN ingredientes_has_alergenos ia ON i.id = ia.ingredientes_id
                                    LEFT JOIN alergenos a ON ia.alergenos_id;");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Usamos fetchAll() para obtener todas las filas

        //array vacio de Ingredientes
        //recorro la consulta y cojo todas las tuplas donde el id se repita
        $alergenos = [];
        foreach ($rows as $row) {
            // Verificamos que estamos procesando el ingrediente correcto
            //si el id del ingrediente es igual a el $id
            if($id == $row['Ingrediente_id']){
                // Si el objeto ingrediente aún no ha sido creado lo creamos
                if (!isset($ingrediente)) {
                    $ingrediente = new Ingredientes(
                        $row['Ingrediente_id'], 
                        $row['nombre'], 
                        $row['foto'], 
                        $row['precio'], 
                        $row['tipo']
                    );
                    
                }
                //cojo los alergenos del ingrediente
                    $alergenos = [
                        'id' => $row['Alergeno_id'],
                    ];
                    //añado los alergenso de dicho ingrediente al su array
                    foreach ($alergenos as $alergeno) {
                        $ingrediente->addAlergeno($alergeno);
                    }
            }
        }                   
            return $ingrediente;
    }

    public function ingredientesCompletos(){
        $connection = Conexion::getConection();
        $stmt = $connection->prepare("SELECT id 
                                    FROM ingredientes;
                                    ");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Usamos fetchAll() para obtener todas las filas
        //meto los id en un array
        $IDIngredientes = [];
        //hago un bucle en el que meto los id de los ingredientes
        foreach ($rows as $row){
            $IDIngredientes = $row;

            foreach($IDIngredientes as $ID){
            $arrayIngredientes[] = $this->ingredienteCompletoPorId($ID);
            json_encode($arrayIngredientes);

            }

        }

        return $arrayIngredientes;
    }

}



            // // Cuando el id no es un número (por ejemplo, "todos")
            // foreach ($rows as $row) {
            //     $ingrediente_id = $row['Ingrediente_id'];
    
            //     // Si el ingrediente no ha sido agregado al array, lo creamos
            //     if (!isset($ingredientes[$ingrediente_id])) {
            //         $ingredientes[$ingrediente_id] = new Ingredientes(
            //             $row['Ingrediente_id'],
            //             $row['nombre'],
            //             $row['foto'],
            //             $row['precio'],
            //             $row['tipo']
            //         );
            //     }
    
            //     // Añadimos el alérgeno al ingrediente
            //     $ingredientes[$ingrediente_id]->addAlergeno($row['Alergeno_id']);
            // }
    
            // // Si $id es "todos", retornamos todos los ingredientes con sus alérgenos
            // $resultado = array_values($ingredientes);  // Retorna un array de todos los ingredientes con alérgenos
    //     }



        // $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        // //array vacio de Ingredientes
        // if(is_numeric($id)){
        //     //recorro la consulta y cojo todas las tupplas donde el id se repita
        //     $alergenos = [];
        //     foreach($rows as $row){
        //         //cojo el id del o los alergnos 
        //         $alergenos = $row['Alergeno_id'];
        //         if(!isset($ingrediente)){
        //             $ingrediente = new Ingredientes($row['Ingrediente_id'],$row['nombre'],$row['foto'],$row['precio'],$row['tipo']);
        //         }
        //         //meto el array de alergenos en el ingrediente
        //         $ingrediente->addAlergeno($alergenos);
        //     }
        // }else{
        //     //recorro $rows
        //     foreach($rows as $row){
        //         $Ingredinete_id = $row['Ingrediente_id'];
        //         $alergenos = $row['Alergeno_id'];
        //         while($Ingredinete_id == $row['Ingrediente_id']){
        //             if(!isset($ingrediente)){//devuelve verdadero si es falso
        //                 $ingrediente = new Ingredientes($row['Ingrediente_id'],$row['nombre'],$row['foto'],$row['precio'],$row['tipo']);
        //                 //cuando el ingrediente_id sea distinto al anta

        //             }
        //         }

        //     }


        //     //sacamos todos los ingredientes con sus alergenos 


        // }





        // if (is_numeric($id)) {
        //     return $row = new Ingredientes($row['id'], $row['nombre'], $row['foto'], $row['precio'],$row['tipo'],$row['ingredientes_id'],$row);
        // }
        // elseif($id =="todos"){
        //     $rows = [];
        //     $rows []=new Ingredientes($row['id'], $row['nombre'], $row['foto'], $row['precio'],$row['tipo'],$row['id']);
        // }else{
        //     throw new Exception ('Error no se ha podido encontrar el ingrediente');
        // }
        // return $row; // Si no se encuentra el kebab


?>