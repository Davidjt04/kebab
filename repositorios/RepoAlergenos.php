<?php


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
            return new Alergenos($row['id'],$row['foto'],$row['nombre']);
        }
    }

    public function findAll(){
        $conexion = Conexion::getConection();
        $stmt = $conexion->query("SELECT * FROM alergenos");
        //creo el array donde meteré todas las tupplas
        $alergenos = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $alergenos[] = new Alergenos($row['id'],$row['foto'],$row['nombre']);
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

    public function crear($id, $foto, $nombre) {
        // Verificamos si el alérgeno con este ID ya existe
        $alergenoExistente = $this->findById($id);

        if ($alergenoExistente) {
            // Si existe, hacemos un update
            return $this->update($id, $foto, $nombre);
        } else {
            // Si no existe, hacemos un create
            $conexion = Conexion::getConection();
            $stmt = $conexion->prepare("INSERT INTO alergenos (id, foto, nombre) VALUES (:id, :foto, :nombre)");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        }
    }

    public function update($id, $foto, $nombre) {
        $conexion = Conexion::getConection();
        $stmt = $conexion->prepare("UPDATE alergenos SET foto = :foto, nombre = :nombre WHERE id = :id");
        $stmt->bindParam(':foto', $foto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }


}
?>