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
        $stmt->bindParam("1",$id,PDO::PARAM_INT);
        $stmt->execute(); 
        //FALTA METER EL FETCH PARA QUE ME ENCUENTRE LA LNEA QUE QUIERO EN LA TABLA 

        //ESTO DEBERÑIA DE FUNCIONAR COGIENDO EL MARCADOR DE POSICION POSICIONAL EN LUGAR DE NOMBRADO
    }
}
?>