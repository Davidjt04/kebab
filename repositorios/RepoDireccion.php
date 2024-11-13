<?php
require_once ROOT_PATH . 'repositorios/Conexion.php';
require_once ROOT_PATH . 'clases/Direccion.php';

class repoDireccion{
    //FIND BY ID 
    public function findById($id){
        //metemos la conexion
        $conexion = Conexion::getConection();
        //creamos el objeto stmt
        $stmt = $conexion->prepare("SELECT * FROM direccion WHERE iddireccion = :iddireccion");
        $stmt->bindParam(':iddireccion',$id,PDO::PARAM_INT);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Direccion($row['iddireccion'],$row['direccion'],$row['usuario_id']);
        }
    }

    public function findAll(){
        $conexion = Conexion::getConection();
        $stmt = $conexion->query("SELECT * FROM direccion");
        //creo el array donde meteré todas las tupplas
        $direcciones = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $direcciones[] = new Direccion($row['id'],$row['direccion']);
        }
        return $direcciones;
    }

    public function delete($id){
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare('DELETE FROM direccion WHERE id = :id');
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount()>0;
    }

    //crear y modificar 
    public function crear($id, $direccion, $usuario_id) {
        // Verificamos si el alérgeno con este ID ya existe
        $direccionExistente = $this->findById($id);

        if ($direccionExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $direccion, $usuario_id);
        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO direccion (iddireccion, direccion, usuario_id) VALUES (:iddireccion, :direccion, :usuario_id)");
            $stmt->bindParam(':iddireccion', $id, PDO::PARAM_INT);
            $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->rowCount() > 0;
        }
    }

    public function update($id, $direccion,$usuario_id) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE direccion SET iddireccion = :iddireccion, direccion = :direccion, usuario_id = :usuario_id WHERE iddireccion = :iddireccion");
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':iddireccion', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }


}









?>