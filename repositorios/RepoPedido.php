<?php
require_once ROOT_PATH . 'repositorios/Conexion.php';
require_once ROOT_PATH . 'clases/Pedido.php';

class repoPedido{
    //FIND BY ID 
    public function findById($id){
        //metemos la conexion
        $conexion = Conexion::getConection();
        //creamos el objeto stmt
        $stmt = $conexion->prepare("SELECT * FROM pedido WHERE id = ?");
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Pedido($row['id'],$row['estado'],$row['fecha'],$row['precio']);
        }
    }

    public function findAll(){
        $conexion = Conexion::getConection();
        $stmt = $conexion->query("SELECT * FROM pedido");
        //creo el array donde meteré todas las tupplas
        $pedido = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $pedido[] = new Pedido($row['id'],$row['estado'],$row['fecha'],$row['precio']);
        }
        return $pedido;
    }

    public function delete($id){
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare('DELETE FROM pedido WHERE id = ?');
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount()>0;
    }


    public function crear($id, $estado, $fecha, $precio, $usuario_id, $lineasPedido = []) {
        // Verificamos si el ingrediente con este ID ya existe
        $PedidoExistente = $this->findById($id);

        if ($PedidoExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $estado, $fecha, $precio,$usuario_id, $lineasPedido);

        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO ingredientes (id, estado, fecha, precio, usuario_id, lineasPedido) VALUES (:id, :estado,:fecha, :precio, :usuario_id, :lineasPedido)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':lineasPedido', $lineasPedido);
            $stmt->execute();

            // Si se insertó el pedido, insertamos también sus lineas de pedido
            //si el array de lineas de pedido esta vacío no lo recorremos 
            if ($stmt->rowCount() > 0) {
                if(!empty($lineasPedido)){
                    foreach ($lineasPedido as $lineasPedidoId) {
                        $this->insertarAlergenos($id, $lineasPedidoId);
                    }
                }
            }
            // Obtenemos el ingrediente actualizado
            $lineaPedido = $this->findById($id); 

            // Llenar el array de alérgenos para el ingrediente
            $lineaPedido->llenarAlergenos();
        }
    }
     // Método para actualizar un ingrediente existente
     public function update($id, $estado, $fecha, $precio, $usuario_id, $lineasPedido=[]) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE ingredientes SET estado = :estado, fecha = :fecha, precio = :precio, lineasPedido = :lineasPedido WHERE id = :id");
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':lineasPedido', $lineasPedido);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Actualizamos los alérgenos asociados
        //elimino todos lo alergenos
        $this->eliminarAlergenosAll($id);
        // var_dump($alergenos);
        //Inserto los alergenos nuevos 
        
        foreach ($alergenos as $alergenoId) {
            $this->insertarlineasPedido($id, $alergenoId);//AQUI HICE UNA MODIFICACIÓN
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
    private function insertarlineasPedido($PedidoId,$lineaPedidoId) {
        $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO lineapedido (id, cantidad, precio, lineaPedido, pedido_id) VALUES (:ingredientes_id, :alergenos_id)");
            $stmt->bindParam(':ingredientes_id', $ingredienteId, PDO::PARAM_INT);
            $stmt->bindParam(':alergenos_id', $AlergenoId, PDO::PARAM_INT);
            $stmt->execute();
            
    }

    // Método auxiliar para eliminar todos los alérgenos asociados a un ingrediente
    private function eliminaLineasPedidoAll($ingredienteId) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("DELETE FROM ingredientes_has_alergenos WHERE ingredientes_id = :ingredientes_id");
        $stmt->bindParam(':ingredientes_id', $ingredienteId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Método para obtener alérgenos asociados a un ingrediente
    public function obtenerLineaPedidoPorPedido($ingredienteId) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("SELECT alergenos_id FROM ingredientes_has_alergenos WHERE ingredientes_id = :ingredientes_id");
        $stmt->bindParam(':ingredientes_id', $ingredienteId, PDO::PARAM_INT);
        $stmt->execute();
        //devuelvo un array con los alergenos
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        
    }

}
?>