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

    public function crear($id, $cantidad, $precio, $lineaPedido) {
        //verifico si la linea de pedido ya existe
        $lineaPedidoExistente = $this->findById($id);

        if ($alergenoExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $foto, $nombre);
        } else {
            // Si no existe, hacemos un create
            //valido el JSON que le voy a meter
            //hago el creato como en los demas create 
            //meto el JSON sin pasarlo a string

        }


    }

    //función update
    public function update($id, $cantidad , $precio, $lineaPedido){
        //valido que el json que se inserta es correcto
        //meto los datos en las tablas como los demás update
        //meto el JSON sin pasarlo a string

        

    }






    //tengo un objeto kebab con los ingredientes
    //funcion para validar que el json tiene un objeto kebab con sus ingredientes 
    public function validarLineaPedido($json){
        //descodifico mi json
        $datos = json_decode($json, true); 
        //miro que mi json no este vacío
        if($datos ===null){
            //Defino los campos obligatorios del json 
            $camposObligatorios = ["id", "nombre", "foto", "precio", "descripcion", ""];
            foreach($datos as $clave => $valor){
                if(!isset($clave['nombre'])){
                }
            }    
        }
        //miro que tenga los campos pertinentes 
        /*Los campos que tiene que tener el array son id,nombre,foto,precio,descripcion y un array de ingredintes*/
        

    }


}
?>