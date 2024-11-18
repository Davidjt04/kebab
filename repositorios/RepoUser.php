<?php
class repoUser{
    //FIND BY ID 
    public function findById($id){
        //metemos la conexion
        $conexion = Conexion::getConection();
        //creamos el objeto stmt
        $stmt = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new User($row['id'],$row['nombre'],$row['foto'],$row['contraseña'],$row['direccion'],$row['monedero'],$row['tlf'],$row['carrito'],$row['ubicacion']);
        }
    }

    public function findAll(){
        $conexion = Conexion::getConection();
        $stmt = $conexion->query("SELECT * FROM usuario");
        //creo el array donde meteré todas las tupplas
        $usuarios = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $usuarios[] = new User($row['id'],$row['nombre'],$row['foto'],$row['contraseña'],$row['direccion'],$row['monedero'],$row['tlf'],$row['carrito'],$row['ubicacion']);
        }
        return $usuarios;
    }

    public function delete($id){
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare('DELETE FROM usuario WHERE id = ?');
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount()>0;
    }
}
?>