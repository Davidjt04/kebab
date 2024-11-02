<?php
require_once ROOT_PATH . 'repositorios/RepoKebab.php';
// Crear una instancia del repositorio
$repoKebab = new RepoKebab();

// Ejemplo de uso: encontrar un Kebab por ID
$kebab = $repoKebab->delete(2);
if ($kebab){
    echo $kebab;
}else{
    echo "no se encontro ningun kebab";
}

?>
