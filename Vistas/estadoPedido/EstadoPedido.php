<?php
echo ("<p> PANTALLA DE ESTADO DEL PEDIDO </p>");
require_once ROOT_PATH . 'repositorios/RepoKebab.php';
require_once ROOT_PATH . 'clases/Kebab.php';
// require_once ROOT_PATH . 'repositorios/RepoIngredientes.php';
// require_once ROOT_PATH . 'clases/Ingredientes.php';


//Conexion a la base de datos 
$repoAlergeno = new RepoKebab();
// $repoAlergeno = new RepoIngredientes();


echo ($repoAlergeno->crear(5,'de la casa','fo',6,'harO',[1,2,3]));
// var_dump($repoAlergeno->findById(1));

// $repoAlergeno->update(1,'inge','fi',7,'haaro',[1,2,3]);
// var_dump($repoAlergeno->findById(1));





// $ingrediente = new Ingredientes();
// $array = $ingrediente->getAlergenos();
// var_dump($array);

