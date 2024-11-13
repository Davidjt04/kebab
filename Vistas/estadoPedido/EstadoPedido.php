<?php
echo ("<p> PANTALLA DE ESTADO DEL PEDIDO </p>");
require_once ROOT_PATH . 'repositorios/RepoDireccion.php';
require_once ROOT_PATH . 'clases/Direccion.php';
// require_once ROOT_PATH . 'repositorios/RepoIngredientes.php';
// require_once ROOT_PATH . 'clases/Ingredientes.php';


//Conexion a la base de datos 
// $repoAlergeno = new RepoKebab();
$repoAlergeno = new RepoDireccion();
// $repoAlergeno = new RepoIngredientes();

// echo ($repoAlergeno->crear(1,'calle nose',2));





// echo ($repoAlergeno->crear(5,'de la casa','fo',6,'harO',[1,2,3]));
// var_dump($repoAlergeno->findById(1));

// $repoAlergeno->update(1,'inge','fi',7,'haaro',[1,2,3]);
// var_dump($repoAlergeno->findById(1));





// $ingrediente = new Ingredientes();
// $array = $ingrediente->getAlergenos();
// var_dump($array);

