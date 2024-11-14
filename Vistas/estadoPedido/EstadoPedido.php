<?php
echo ("<p> PANTALLA DE ESTADO DEL PEDIDO </p>");
// require_once ROOT_PATH . 'repositorios/RepoDireccion.php';
// require_once ROOT_PATH . 'clases/Direccion.php';

// require_once ROOT_PATH . 'repositorios/RepoIngredientes.php';
// require_once ROOT_PATH . 'clases/Ingredientes.php';

// require_once ROOT_PATH . 'repositorios/RepoKebab.php';
// require_once ROOT_PATH . 'clases/Kebab.php';

// require_once ROOT_PATH . 'repositorios/RepoAlergenos.php';
// require_once ROOT_PATH . 'clases/Alergenos.php';

// require_once ROOT_PATH . 'repositorios/RepoLineaPedido.php';
// require_once ROOT_PATH . 'clases/LineaPedido.php';

require_once ROOT_PATH . 'repositorios/RepoPedido.php';
require_once ROOT_PATH . 'clases/Pedido.php';

//Conexion a la base de datos 
// $repoAlergeno = new RepoKebab();
// $repoAlergeno = new RepoDireccion();
// $repoAlergeno = new RepoIngredientes();
// $repoAlergeno = new RepoAlergenos();
// $repoAlergeno = new RepoLineaPedido();
$repoAlergeno = new RepoPedido();


// echo ($repoAlergeno->crear(2,'calle nose',1));
// var_dump($repoAlergeno->findById(1));

// var_dump($repoAlergeno->findAll());
var_dump($repoAlergeno->delete(1));
// $json = [
//     "pedido_id" => 101,
//     "fecha" => "2024-11-14",
//     "cliente" => [
//         "nombre" => "Juan Pérez",
//         "correo" => "juan.perez@example.com",
//         "direccion" => "Calle Falsa 123, Ciudad, País",
//         "telefono" => "987654321"
//     ],
//     "productos" => [
//         [
//             "producto_id" => 1,
//             "nombre" => "Laptop",
//             "cantidad" => 1,
//             "precio" => 799.99
//         ],
//         [
//             "producto_id" => 2,
//             "nombre" => "Mouse inalámbrico",
//             "cantidad" => 2,
//             "precio" => 19.99
//         ]
//     ],
//     "total" => 839.97,
//     "estado" => "pendiente"
// ];


// echo ($repoAlergeno->crear(2,1,'2024-11-14 12:00:00',3,1));





// $repoAlergeno->crear(3,'de la casa','fofo',6,'heero');


