<?php
require_once ROOT_PATH . 'repositorios/Conexion.php';
require_once ROOT_PATH . 'clases/Alergenos.php';

class repoAlergenos{
    //FIND BY ID 
    public function findById($id){
        //metemos la conexion
        $conexion = Conexion::getConection();
        //creamos el objeto stmt
        $stmt = $conexion->prepare("SELECT * FROM alergenos WHERE id = ?");
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Alergenos($row['id'],$row['descripcion'],$row['foto'],$row['nombre']);
        }
    }

    public function findAll(){
        $conexion = Conexion::getConection();
        $stmt = $conexion->query("SELECT * FROM alergenos");
        //creo el array donde meteré todas las tupplas
        $alergenos = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $alergenos[] = new Alergenos($row['id'],$row['descripcion'],$row['foto'],$row['nombre']);
        }
        return $alergenos;
    }

    public function delete($id){
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare('DELETE FROM alergenos WHERE id = ?');
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount()>0;
    }
}
?>