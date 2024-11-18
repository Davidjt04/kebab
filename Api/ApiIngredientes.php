<?php
/*codigo que manda la response */
//cogemos el REQUEST_METHOD pertinente
include '../controladores/ControlIngrediente.php';
$request = $_SERVER['REQUEST_METHOD'];
switch ($request) {
    case 'GET':
        $cadena = $_GET['valor'];
        var_dump($cadena);
        //Creo un objeto controlador
        $control = new controlIngrediente();
        $tupla = $control->cogerDatos($cadena);
        echo json_encode($tupla);
        break;
    case 'POST':    



        break;

    default:
        throw new Exception("Error al procesar la Request");
        
}

?>