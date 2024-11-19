<?php
include '../repositorios/RepoIngredientes.php';
    class controlIngrediente{

        public function cogerDatos($cadena){
            $resultado = null;
            if(is_numeric($cadena)){
                //es un numero
                //cogemos la tupla de ese numero que es el id
                $repoIngredientes = new RepoIngredientes();
                $Ingrediente = $repoIngredientes->ingredienteCompletoPorId($cadena);
                $resultado = $Ingrediente;

            }else{
                //es "todos"
                //cogo todas las tuplas 
                $repoIngredientes = new RepoIngredientes();
                $Ingredientes[] = $repoIngredientes->ingredientesCompletos();
                $resultado = $Ingredientes;

            }
            return $resultado;
        }

        public function meterDatos($Obj){
            //llamo al crear
            $repo = new RepoIngredientes();
            $datos = json_encode($Obj);
            $arrayDatos = json_decode($datos,true);
            // var_dump($arrayDatos);
            $id = $arrayDatos['id'];
            $nombre = $arrayDatos['nombre'];
            $foto = $arrayDatos['foto'];
            $precio = $arrayDatos['precio'];
            $tipo = $arrayDatos['tipo'];
            //inicializo el array alergenos 
            $alergenos =[];
            //meto los componenetes de $arrayDatos en $alergenos
            $alergenos = array_merge($alergenos, $arrayDatos['alergenos']);

            $repo->crear($id,$nombre,$foto,$precio,$tipo,$alergenos);
            // echo"realizado satisfactoriamente";
        }

        public function borrarDatos($id){
            //llamo al repo
            $repo = new RepoIngredientes();
            //borramnos primero de la tabla de la rlacion y despues de la tabla de ingredientes
            $repo->deleteIngredientes_has_alergenos($id);
            $repo->delete($id);
            // echo"realizado satisfactoriamente";
        }
    }  
?>