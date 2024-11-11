<?php
echo ("<p> PANTALLA DE ESTADO DEL PEDIDO </p>");
require_once ROOT_PATH . 'repositorios/RepoIngredientes.php';
require_once ROOT_PATH . 'clases/Ingredientes.php';
//Conexion a la base de datos 
$repoAlergeno = new RepoIngredientes();
// echo ($repoAlergeno->crear(7,'ingr','foto',6,'harO'));
var_dump($repoAlergeno->findById(3));

