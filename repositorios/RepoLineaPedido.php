<?php
require_once ROOT_PATH . 'repositorios/Conexion.php';
require_once ROOT_PATH . 'clases/LineaPedido.php';

class repoLineaPedido{
    //FIND BY ID 
    public function findById($id){
        //metemos la conexion
        $conexion = Conexion::getConection();
        //creamos el objeto stmt
        $stmt = $conexion->prepare("SELECT * FROM lineapedido WHERE id = ?");
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new LineaPedido($row['id'],$row['cantidad'],$row['precio'],$row['lineaPedido']);
        }
    }

    public function findAll(){
        $conexion = Conexion::getConection();
        $stmt = $conexion->query("SELECT * FROM lineapedido");
        //creo el array donde meteré todas las tupplas
        $lineapedido = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $lineapedido[] = new LineaPedido($row['id'],$row['cantidad'],$row['precio'],$row['lineaPedido']);
        }
        return $lineapedido;
    }

    public function delete($id){
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare('DELETE FROM lineapedido WHERE id = ?');
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount()>0;
    }
}
?>