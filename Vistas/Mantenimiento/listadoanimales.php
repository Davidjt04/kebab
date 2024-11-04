<?php
require_once ROOT_PATH . 'repositorios/RepoUser.php';
require_once ROOT_PATH . 'repositorios/Conexion.php';

// Crear una instancia del repositorio
$repoAlergenos = new RepoUser();

// Ejemplo de uso: encontrar un Kebab por ID
$Alergeno = $repoAlergenos->findAll();
if ($Alergeno){
    foreach ($Alergeno as $item){
        echo $item . "<br>";
    }

}else{
    echo "no se encontro ningun kebab";
}

?>
