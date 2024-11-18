<?php
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

    public function crear($id, $cantidad, $precio, $lineaPedido, $pedido_id, $kebab) {
        //verifico si la linea de pedido ya existe
        $lineaPedidoExistente = $this->findById($id);

        if ($lineaPedidoExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $cantidad, $precio, $lineaPedido, $pedido_id,$kebab);
        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO lineapedido (id, cantidad, precio, lineaPedido, pedido_id) VALUES (:id, :cantidad, :precio, :lineaPedido, :pedido_id)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':precio', $precio);
            $jsonLineaPedido= json_encode($kebab);
            $stmt->bindParam(':lineaPedido', $jsonLineaPedido);
            $stmt->bindParam(':pedido_id', $pedido_id, PDO::PARAM_INT);
            $stmt->execute();
        }


    }

    //función update
    public function update($id, $cantidad , $precio, $lineaPedido, $pedido_id,$kebab){
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE lineapedido SET id = :id, cantidad = :cantidad, precio = :precio, lineaPedido = :lineaPedido, pedido_id = :pedido_id WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $precio);
        $jsonLineaPedido= json_encode($kebab);
        $stmt->bindParam(':lineaPedido', $jsonLineaPedido);
        $stmt->bindParam(':pedido_id', $pedido_id, PDO::PARAM_INT);       
        $stmt->execute();
        return $stmt->rowCount() > 0;
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