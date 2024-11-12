<?php
require_once ROOT_PATH . 'repositorios/Conexion.php';
require_once ROOT_PATH . 'clases/Direccion.php';

class repoDireccion{
    //FIND BY ID 
    public function findById($id){
        //metemos la conexion
        $conexion = Conexion::getConection();
        //creamos el objeto stmt
        $stmt = $conexion->prepare("SELECT * FROM direccion WHERE id = :id");
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Direccion($row['id'],$row['direccion']);
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



}








?>