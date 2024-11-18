<?php
include '../repositorios/RepoIngredientes.php';
    class controlIngrediente{

        public function cogerDatos($cadena){
            $resultado = null;
            if(is_numeric($cadena)){
                //es un numero
                //cogemos la tupla de ese numero que es el id
                $repoIngredientes = new RepoIngredientes();
                $Ingrediente = $repoIngredientes->ingredienteCompleto($cadena);
                $resultado = $Ingrediente;

            }elseif($cadena =="todos"){
                //es "todos"
                //cogo todas las tuplas 
                $repoIngredientes = new RepoIngredientes();
                $Ingredientes[] = $repoIngredientes->ingredienteCompleto($cadena);
                $resultado = $Ingredientes;

            }else{
                throw new Exception("la cadena no es ni todos ni un número");
            }
            return $resultado;
        }
    }  
?>